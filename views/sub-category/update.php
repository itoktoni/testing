<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SubCategory */

$this->title = Yii::t('app', 'Update Sub Category: ' . $model->sub_category_id, [
    'nameAttribute' => '' . $model->sub_category_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sub Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sub_category_id, 'url' => ['view', 'id' => $model->sub_category_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sub-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
