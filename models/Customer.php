<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property string $title
 * @property string $url
 * @property string $content
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            ['alamat', 'string']
        ];
    }
    
        
    public static function primaryKey(){
        return ['id_customer'];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_customer' => 'ID',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
        ];
    }
    
}
