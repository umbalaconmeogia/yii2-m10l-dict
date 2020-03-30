<?php

namespace umbalaconmeogia\m10ldict\models;

use Yii;

/**
 * This is the model class for table "m10l_dict_term".
 *
 * @property int $id
 * @property int $dict_id
 * 
 * @property Translation[] $translations
 */
class Term extends \yii\db\ActiveRecord
{
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
     * Delete all relative Translation when delete a Term.
     * {@inheritdoc}
     */
    public function delete()
    {
        Translation::deleteAll('term_id = :termId', ['termId' => $this->id]);
        return parent::delete();
    }
}
