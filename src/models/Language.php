<?php

namespace umbalaconmeogia\m10ldict\models;

use Yii;

/**
 * This is the model class for table "m10l_dict_language".
 *
 * @property int $id
 * @property int|null $dict_id
 * @property string $code
 * @property string $name
 * 
 * @property Translation[] $translations
 */
class Language extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm10l_dict_language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dict_id'], 'integer'],
            [['code', 'name'], 'required'],
            [['code', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dict_id' => 'Dict ID',
            'code' => 'Code',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(Translation::class, ['term_id' => 'id']);
    }

    /**
     * Delete all relative Translation when delete a Language.
     * {@inheritdoc}
     */
    public function delete()
    {
        Translation::deleteAll('language_id = :languageId', ['languageId' => $this->id]);
        return parent::delete();
    }
}
