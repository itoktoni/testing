<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = $model->order_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->order_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->order_id], [
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
            'order_id',
            'order_date',
            'order_name',
            'order_email:email',
            // 'order_province',
            // 'order_city',
            // 'order_sub',
            // 'order_address:ntext',
            // 'order_weight',
            // 'order_courier',
            // 'order_service',
            // 'order_cost_delivery',
            // 'order_notes:ntext',
            // 'order_user',
            // 'voucher_code',
            // 'voucher_name',
            // 'voucher_value',
            // 'order_total',
            // 'order_payment',
        ],
    ]) ?>

</div>
