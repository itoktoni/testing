<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = $model->id_customer;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id_customer], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id_customer], [
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
            'id_customer',
            'nama',
            'alamat:ntext',
            'kode_pos',
            'telp',
            'fax',
            'email:email',
            'website',
            'pendapatan',
            'member_of',
            'jumlah_karyawan',
            'nama_pemilik',
            'rating',
            'id_propinsi',
            'id_kota',
            'id_kategori_customer',
            'id_tipe_customer',
            'id_campaign',
            'id_jenis_industri',
            'catatan',
            'warning_sales',
            'warning_kirim',
            'warning_tagih',
            'id_sales',
            'acc_norek',
            'acc_bank',
            'acc_pemilik',
            'siup_no',
            'tdp_no',
            'npwp',
            'ktp_no',
            'created_by',
            'created_on',
            'modified_by',
            'modified_on',
            'plafon',
            'top',
        ],
    ]) ?>

</div>
