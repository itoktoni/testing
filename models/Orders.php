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
class Orders extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'orders';
    }

    public static function primaryKey() {
        return ['order_id'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            ['order_id', 'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'order_id',
            'order_date',
            'order_name',
            'order_email',
            'order_province',
            'order_city',
            'order_sub',
            'order_address',
            'order_weight',
            'order_courier',
            'order_service',
            'order_cost_delivery',
            'order_notes',
            'order_user',
        ];
    }

}
