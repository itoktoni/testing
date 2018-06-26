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
class Voucher extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'voucher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['voucher_code'], 'required'],
        ];
    }

    public static function primaryKey() {
        return ['voucher_id'];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [

            'voucher_id' => 'ID',
            'voucher_code' => 'Code',
            'voucher_name' => 'Name',
            'voucher_description' => 'Description',
            'voucher_operan' => 'Operan',
            'voucher_validation' => 'Validation',
        ];
    }

}
