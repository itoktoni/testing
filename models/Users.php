<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\base\Model;
use Yii;

class Users extends ActiveRecord {

    public static function primaryKey() {
        return ['id'];
    }

    public static function tableName() {
        return 'users';
    }

    public function rules() {
        
        return [
            [['email', 'password','first_name', 'last_name'], 'required'],
            array('email', 'email', 'message' => "The email isn't correct"),
            array('email', 'unique', 'message' => 'Email already exists!'),
        ];
    }

}
