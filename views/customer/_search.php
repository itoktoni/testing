<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CustomerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_customer') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'alamat') ?>

    <?= $form->field($model, 'kode_pos') ?>

    <?= $form->field($model, 'telp') ?>

    <?php // echo $form->field($model, 'fax') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'website') ?>

    <?php // echo $form->field($model, 'pendapatan') ?>

    <?php // echo $form->field($model, 'member_of') ?>

    <?php // echo $form->field($model, 'jumlah_karyawan') ?>

    <?php // echo $form->field($model, 'nama_pemilik') ?>

    <?php // echo $form->field($model, 'rating') ?>

    <?php // echo $form->field($model, 'id_propinsi') ?>

    <?php // echo $form->field($model, 'id_kota') ?>

    <?php // echo $form->field($model, 'id_kategori_customer') ?>

    <?php // echo $form->field($model, 'id_tipe_customer') ?>

    <?php // echo $form->field($model, 'id_campaign') ?>

    <?php // echo $form->field($model, 'id_jenis_industri') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <?php // echo $form->field($model, 'warning_sales') ?>

    <?php // echo $form->field($model, 'warning_kirim') ?>

    <?php // echo $form->field($model, 'warning_tagih') ?>

    <?php // echo $form->field($model, 'id_sales') ?>

    <?php // echo $form->field($model, 'acc_norek') ?>

    <?php // echo $form->field($model, 'acc_bank') ?>

    <?php // echo $form->field($model, 'acc_pemilik') ?>

    <?php // echo $form->field($model, 'siup_no') ?>

    <?php // echo $form->field($model, 'tdp_no') ?>

    <?php // echo $form->field($model, 'npwp') ?>

    <?php // echo $form->field($model, 'ktp_no') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_on') ?>

    <?php // echo $form->field($model, 'modified_by') ?>

    <?php // echo $form->field($model, 'modified_on') ?>

    <?php // echo $form->field($model, 'plafon') ?>

    <?php // echo $form->field($model, 'top') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
