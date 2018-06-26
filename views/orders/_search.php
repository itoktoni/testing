<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'order_id') ?>

    <?= $form->field($model, 'order_date') ?>

    <?= $form->field($model, 'order_name') ?>

    <?= $form->field($model, 'order_email') ?>

    <?= $form->field($model, 'order_province') ?>

    <?php // echo $form->field($model, 'order_city') ?>

    <?php // echo $form->field($model, 'order_sub') ?>

    <?php // echo $form->field($model, 'order_address') ?>

    <?php // echo $form->field($model, 'order_weight') ?>

    <?php // echo $form->field($model, 'order_courier') ?>

    <?php // echo $form->field($model, 'order_service') ?>

    <?php // echo $form->field($model, 'order_cost_delivery') ?>

    <?php // echo $form->field($model, 'order_notes') ?>

    <?php // echo $form->field($model, 'order_user') ?>

    <?php // echo $form->field($model, 'voucher_code') ?>

    <?php // echo $form->field($model, 'voucher_name') ?>

    <?php // echo $form->field($model, 'voucher_value') ?>

    <?php // echo $form->field($model, 'order_total') ?>

    <?php // echo $form->field($model, 'order_payment') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
