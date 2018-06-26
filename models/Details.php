<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $product_id
 * @property string $product_name
 * @property string $product_url
 * @property string $product_image
 * @property string $product_description
 * @property int $product_price
 * @property int $product_qty
 */
class Details extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'order_detail';
    }

    public static function primaryKey() {
        return ['detail'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'detail',
            'product_id',
            'product_name',
            'product_url',
            'product_image',
            'product_price',
            'product_weight',
            'product_qty',
        ];
    }
    
//    public function behaviors() {
//        return [
//            [
//                'class' => 'mdm\autonumber\Behavior',
//                'attribute' => 'order_id', // required
//                'group' => $this->order_id, // optional
//                'value' => 'SO.' . date('Y-m-d') . '.?', // format auto number. '?' will be replaced with generated number
//                'digit' => 8 // optional, default to null. 
//            ],
//        ];
//    }

}
