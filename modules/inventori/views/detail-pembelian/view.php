<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\inventori\models\DetailPembelian */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Detail Pembelians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="detail-pembelian-view">

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
            'id',
            'qty',
            [        
                'attribute' => 'pembelian_id',
                'label' => 'Pembelian',
                'value' => $model->pembelian->kode,
            ],
            [        
                'attribute' => 'barang_id',
                'label' => 'Barang',
                'value' => $model->barang->nama,
            ],
            'harga',
            'deskripsi',
        ],
    ]) ?>

</div>
