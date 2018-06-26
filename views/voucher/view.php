<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Voucher */

$this->title = $model->voucher_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vouchers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="voucher-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->voucher_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->voucher_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'voucher_id',
            'voucher_code',
            'voucher_name',
            'voucher_description',
            'voucher_operan',
            'voucher_validation',
        ],
    ]) ?>

</div>
