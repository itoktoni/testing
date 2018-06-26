<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class Config extends ActiveRecord
{
    public static function getDb() {
        return \yii::$app->get('sqlite');
    }
    
    public static function primaryKey(){
        return ['userid'];
    }
    
    public static function tableName(){
        return 'users';
    }
   
    public function rules()
    {
        return [
            [['username', 'password', 'email'], 'required'],
            [['email'], 'email'],
            [['email','username'], 'unique'],
        ];
    }
}