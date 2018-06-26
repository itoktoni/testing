<?php

namespace app\models;

use yii\base\Model;

class Test extends \yii\db\ActiveRecord {

    public static function primaryKey() {
        return ['id'];
    }

    public static function tableName() {
        return 'customers';
    }

    public function rules() {
        return [
            [['first_name', 'email'], 'required'],
            [['email'], 'email'],
            [['email'], 'unique'],
        ];
    }

    public function behaviors() {
        return [
            [
                'class' => 'mdm\autonumber\Behavior',
                'attribute' => 'id', // required
                'group' => $this->id, // optional
                'value' => 'SA.' . date('Y-m-d') . '.?', // format auto number. '?' will be replaced with generated number
                'digit' => 8 // optional, default to null. 
            ],
        ];
    }

}
