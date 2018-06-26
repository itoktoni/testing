<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'order_id',
            'order_date',
            'order_name',
            'order_email:email',
            // 'order_province',
            //'order_city',
            //'order_sub',
            //'order_address:ntext',
            //'order_weight',
            //'order_courier',
            //'order_service',
            //'order_cost_delivery',
            //'order_notes:ntext',
            //'order_user',
            //'voucher_code',
            //'voucher_name',
            //'voucher_value',
            //'order_total',
            // 'order_payment',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
