<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_name')->textInput(['maxlength' => true]) ?>

    <?php
	echo $form->field($model, 'category_gendre')->dropdownList([
	        'POP' => 'POP', 
	        'JAZZ' => 'JAZZ',
	        'ROCK' => 'ROCK',
	        'INDIE' => 'INDIE',
	    ],
	    ['prompt'=>'Select Gendre']
	);
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
