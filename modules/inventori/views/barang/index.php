<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\inventori\models\Merk;
use backend\modules\inventori\models\Satuan;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\inventori\models\BarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Barang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barang-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Barang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nama',
            'kode',
            [
                'label' => 'Satuan',
                'attribute'=> 'satuan_id',
                'value' => 'satuan.nama',
                'filter'=> ArrayHelper::map(Satuan::find()->asArray()->all(), 'id', 'nama'),
            ],
            [
                'label' => 'Merk',
                'attribute'=>'merk_id',
                'value' => 'merk.nama',
                'filter'=> ArrayHelper::map(Merk::find()->asArray()->all(), 'id', 'nama'),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
