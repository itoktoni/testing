<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\VarDumper;
use yii\grid\GridView;
use yii\widgets\Pjax;
?>
<h1>test/index</h1>

<p>
    You may change the content of this page by modifying
</p>
<?php Pjax::begin(); ?>
<?=
GridView::widget([
    'dataProvider' => $data,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        ['label' => 'Primary Key', 'attribute' => 'id'],
        ['label' => 'Nama ', 'attribute' => 'first_name'],
        'last_name',
        'email:email',
        'gender',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]);
?>
<?php Pjax::end(); ?>