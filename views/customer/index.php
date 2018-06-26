<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Customers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Customer'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php if ($this->beginCache($key, ['duration' => 3600])) :?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id_customer',
            'nama',
            'alamat:ntext',
            'kode_pos',
            'telp',
            //'fax',
            //'email:email',
            //'website',
            //'pendapatan',
            //'member_of',
            //'jumlah_karyawan',
            //'nama_pemilik',
            //'rating',
            //'id_propinsi',
            //'id_kota',
            //'id_kategori_customer',
            //'id_tipe_customer',
            //'id_campaign',
            //'id_jenis_industri',
            //'catatan',
            //'warning_sales',
            //'warning_kirim',
            //'warning_tagih',
            //'id_sales',
            //'acc_norek',
            //'acc_bank',
            //'acc_pemilik',
            //'siup_no',
            //'tdp_no',
            //'npwp',
            //'ktp_no',
            //'created_by',
            //'created_on',
            //'modified_by',
            //'modified_on',
            //'plafon',
            //'top',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php 
     $this->endCache();
    endif;
    ?>
    <?php Pjax::end(); ?>
</div>
