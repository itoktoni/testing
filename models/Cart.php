<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\base\Model;
use Yii;

class Cart extends ActiveRecord {

    public static function getDb() {
        return Yii::$app->get('sqlite');
    }

    public static function primaryKey() {
        return ['session'];
    }

    public static function tableName() {
        return 'cart';
    }

    public function rules() {
        return [
            [['qty','product_id','product_name','product_url','product_image','session'], 'required'],
            ['qty', 'integer', 'integerOnly'=>true, 'min' => 0],
        ];
    }

}
