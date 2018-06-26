<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 * @property string $url
 * @property string $content
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_name', 'category_gendre'], 'required'],
            ['category_url', 'string']
        ];
    }
    
        
    public static function primaryKey(){
        return ['category_id'];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'ID',
            'category_name' => 'Title',
            'category_gendre' => 'Gendre',
        ];
    }
    
    public function getProduct(){
        
         return $this->hasMany(Product::className(), ['product_category_id' => 'category_id'])->all();
        
    }
}
