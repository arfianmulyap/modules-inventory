<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\inventori\models\Pembelian */

$this->title = $model->kode;
$this->params['breadcrumbs'][] = ['label' => 'Pembelians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pembelian-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'kode',
            'tanggal',
            'total',
            [        
                'attribute' => 'vendor_id',
                'label' => 'Vendor',
                'value' => $model->vendor->nama,
            ],
        ],
    ]) ?>

    <div class="col-lg-10">
    <?= DetailView::widget([
    'model' => $detailPembelians,
    'attributes' => [
        'id',
        'qty',
        // [        
        //     'attribute' => 'pembelian_id',
        //     'label' => 'Pembelian',
        //     'value' => $model->pembelian->kode,
        // ],
        // [        
        //     'attribute' => 'barang_id',
        //     'label' => 'Barang',
        //     'value' => $model->barang->nama,
        // ],
        'harga',
        'deskripsi',
    ],
    ]) ?>

</div>
