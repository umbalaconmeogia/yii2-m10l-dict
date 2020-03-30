<?php

namespace umbalaconmeogia\m10ldict\models;

use Yii;

/**
 * This is the model class for table "m10l_dict_translation".
 *
 * @property int $id
 * @property int|null $term_id
 * @property int|null $language_id
 * @property string|null $translation
 * @property string|null $pronunciation
 */
class Translation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm10l_dict_translation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['term_id', 'language_id'], 'integer'],
            [['translation'], 'string'],
            [['pronunciation'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'term_id' => 'Term ID',
            'language_id' => 'Language ID',
            'translation' => 'Translation',
            'pronunciation' => 'Pronunciation',
        ];
    }
}
