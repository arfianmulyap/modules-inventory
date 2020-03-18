<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\inventori\models\Vendor;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\inventori\models\PembelianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pembelian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembelian-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pembelian', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'kode',
            'tanggal',
            'total',
            [
                'label' => 'Vendor',
                'attribute' => 'vendor_id',
                'value' => 'vendor.nama',
                'filter' => ArrayHelper::map(Vendor::find()->asArray()->all(), 'id', 'nama'),
            ],
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
