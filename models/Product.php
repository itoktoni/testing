<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
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
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'products';
    }
    
    public static function primaryKey(){
        return ['product_id'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_price', 'product_qty', 'product_like'], 'integer'],
            [['product_description'], 'string'],
            array('product_name', 'unique', 'message' => 'Product already exists!'),
            [['product_name', 'product_image'], 'required'],
            [['product_image'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'product_name' => 'Product Name',
            'product_generic' => 'Product generic',
            'product_image' => 'Product Image',
            'product_description' => 'Product Description',
            'product_price' => 'Product Price',
            'product_qty' => 'Product Qty',
            'product_url' => 'Product URL',
            'product_like' => 'Product Like',
        ];
    }
    
    
}
