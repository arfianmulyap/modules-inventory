<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\inventori\models\BarangKeluar */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Barang Keluars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="barang-keluar-view">

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
            'qty',
            'tanggal',
            [   
                'attribute' => 'barang_id',
                'label' => 'Barang',
                'value' => $model->barang->nama,
            ],
            [   
                'attribute' => 'divisi_id',
                'label' => 'Divisi',
                'value' => $model->divisi->nama,
            ],
            [   
                'attribute' => 'gudang_id',
                'label' => 'Gudang',
                'value' => $model->gudang->nama,
            ],
            'nomor',
        ],
    ]) ?>

</div>
