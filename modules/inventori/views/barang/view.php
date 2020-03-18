<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\inventori\models\Barang */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="barang-view">

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
           
            //'id',
            'nama',
            'kode',
            [   
                'attribute' => 'satuan_id',
                'label' => 'Satuan',
                'value' => $model->satuan->nama,
            ],
            [        
                'attribute' => 'merk_id',
                'label' => 'Merk',
                'value' => $model->merk->nama,
            ],
           
        ],
    ]) ?>

</div>
