<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\inventori\models\Pembelian;
use backend\modules\inventori\models\Barang;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\inventori\models\DetailPembelianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detail Pembelian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-pembelian-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Detail Pembelian', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'qty',
            [
                'label' => 'Pembelian',
                'attribute'=>'pembelian_id',
                'value' => 'pembelian.kode',
                'filter'=>ArrayHelper::map(Pembelian::find()->asArray()->all(), 'id', 'kode'),
            ],
            [
                'label' => 'Barang',
                'attribute'=>'barang_id',
                'value' => 'barang.nama',
                'filter'=>ArrayHelper::map(Barang::find()->asArray()->all(), 'id', 'nama'),
            ],
            'harga',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
