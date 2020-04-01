<?php

namespace umbalaconmeogia\m10ldict\models;

use Exception;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "m10l_dict_term".
 *
 * @property int $id
 * @property int $dict_id
 * 
 * @property Translation[] $translations
 * @property Dictionary $dictionary
 */
class Term extends BaseModel
{
    const TRANSLATION_ATTR_DELIMITER = '_';
    const TRANSLATION_ATTR_PREFIX = 'translation' . self::TRANSLATION_ATTR_DELIMITER;
 
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm10l_dict_term';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dict_id'], 'integer'],
            [$this->translationAttributes(), 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        $translationLabels = [];
        if ($this->dictionary) {
            foreach ($this->dictionary->languages as $language) {
                $translationLabels[self::translationAttributeOf($language)] = $language->name;
            }    
        }
        return array_merge($translationLabels, [
            'id' => 'ID',
            'dict_id' => 'Dict ID',
        ]);
    }

    /**
     * Get list attribute "translation_xxx"
     * @return string[]
     */
    public function translationAttributes()
    {
        $attributes = [];
        if ($this->dictionary) {
            foreach ($this->dictionary->languages as $language) {
                $attributes[] = self::translationAttributeOf($language);
            }    
        }
        return $attributes;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(Translation::class, ['term_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDictionary()
    {
        return $this->hasOne(Dictionary::class, ['id' => 'dict_id']);
    }

    /**
     * Delete all relative Translation when delete a Term.
     * {@inheritdoc}
     */
    public function delete()
    {
        Translation::deleteAll('term_id = :termId', ['termId' => $this->id]);
        return parent::delete();
    }

    private $translationOfLanguages = FALSE;

    /**
     * Get translation object specified by langauge id.
     * @param int $languageId
     * @return Translation
     */
    public function getTranslationOf($languageId)
    {
        if ($this->translationOfLanguages === FALSE) {
            $this->translationOfLanguages = self::hashModels($this->translations, 'language_id');
        }
        return $this->translationOfLanguages[$languageId];
    }

    /**
     * @var Translation[]
     */
    private $temporaryTranslations = [];

    /**
     * Set translation object specified by langauge id.
     * @param int $languageId
     * @param mixed $value
     */
    public function setTranslationOf($languageId, $value)
    {
        if ($this->id) {
            $translation = Translation::findOneCreateNew(['term_id' => $this->id, 'language_id' => $languageId], FALSE);
            $translation->attributes = $value;
            $translation->save();    
        } else {
            $translation = new Translation();
            $translation->attributes = $value;
            $this->temporaryTranslations[$languageId] = $translation;
        }
    }

    /**
     * Override getter to cope with translation.
     * {@inheritdoc}
     */
    public function __get($name)
    {
        return strpos($name, self::TRANSLATION_ATTR_PREFIX) === 0 ? $this->translationGetter($name) : parent::__get($name);
    }

    /**
     * @param string $name Pattern translation_<languageId>
     * @return Translation
     */
    private function translationGetter($name)
    {
        $nameParts = explode(self::TRANSLATION_ATTR_DELIMITER, $name);
        if (!isset($nameParts[1])) {
            throw new Exception("Invalid property name \"$name\"");
        }
        return $this->getTranslationOf($nameParts[1]);
    }

    /**
     * Get translation attribute name of specified langauge (translation_<languageId>)
     * @param int|Language $language
     * @return string
     */
    public static function translationAttributeOf($language)
    {
        if (is_integer($language)) {
            $language = Language::findOne($language);
        }
        return join('', [self::TRANSLATION_ATTR_PREFIX, $language->id]);
    }

    /**
     * Override getter to cope with translation.
     * {@inheritdoc}
     */
    public function __set($name, $value)
    {
        if (strpos($name, self::TRANSLATION_ATTR_PREFIX) === 0) {
            $this->translationSetter($name, $value);
        } else {
            parent::__set($name, $value);
        }
    }

    /**
     * Set value to a translation.
     * @param string $name
     * @param array $value (attributes of Translation object)
     */
    private function translationSetter($name, $value)
    {
        $nameParts = explode(self::TRANSLATION_ATTR_DELIMITER, $name);
        if (!isset($nameParts[1])) {
            throw new Exception("Invalid property name \"$name\"");
        }
        return $this->setTranslationOf($nameParts[1], $value);
    }

    /**
     * Save translations when creating new.
     * {@inheritdoc}
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($insert) {
            foreach ($this->temporaryTranslations as $languageId => $translation) {
                $translation->language_id = $languageId;
                $translation->term_id = $this->id;
                $translation->save();
            }
        }
    }
}