<?php

namespace umbalaconmeogia\m10ldict\models;

use yii\db\ActiveRecord;

class BaseModel extends ActiveRecord
{
    
    /**
     * Create a hash of model list by a field value.
     * @param ActiveRecord $models
     * @param string $keyField Default by id.
     * @param string $valueField If specified, then this field's value is used as array's value.
     *                           Else set the model instance as value.
     * @return array field $keyValue => ($value or model).
     */
    public static function hashModels($models, $keyField = 'id', $valueField = NULL) {
        $hash = [];
        foreach ($models as $model) {
            $hash[$model->$keyField] = $valueField ? $model->$valueField : $model;
        }
        return $hash;
    }

    /**
     * Find one object that match $condition.
     * If not exist, create new one with specified condition.
     * @param array  $condition
     * @param boolean $saveDb Save record into DB or not incase create new.
     * @return \batsg\models\BaseModel
     */
    public static function findOneCreateNew($condition, $saveDb = FALSE, $className = null)
    {
        if (!$className) {
            $className = static::className();
        }
        $result = $className::findOne($condition);
        if (!$result) {
            $result = \Yii::createObject($className);
            \Yii::configure($result, $condition);
            if ($saveDb) {
                $result->save();
            }
        }
        return $result;
    }
}