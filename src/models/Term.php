<?php

namespace umbalaconmeogia\m10ldict\models;

use Yii;

/**
 * This is the model class for table "m10l_dict_term".
 *
 * @property int $id
 * @property int|null $dict_id
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
}
