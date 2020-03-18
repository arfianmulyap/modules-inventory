<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\inventori\models\Barang;
use backend\modules\inventori\models\Divisi;
use backend\modules\inventori\models\Gudang;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\inventori\models\BarangKeluarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Barang Keluar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barang-keluar-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Barang Keluar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'label' => 'Barang',
                'attribute'=>'barang_id',
                'value' => 'barang.nama',
                'filter'=>ArrayHelper::map(Barang::find()->asArray()->all(), 'id', 'nama'),
            ],
            [
                'label' => 'Divisi',
                'attribute'=>'divisi_id',
                'value' => 'divisi.nama',
                'filter'=>ArrayHelper::map(Divisi::find()->asArray()->all(), 'id', 'nama'),
            ],
            [
                'label' => 'Gudang',
                'attribute'=>'gudang_id',
                'value' => 'gudang.nama',
                'filter'=>ArrayHelper::map(Gudang::find()->asArray()->all(), 'id', 'nama'),
            ],
            'qty',
            'tanggal',
            //'nomor',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
