<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\inventori\models\BarangKeluar */

$this->title = 'Update Barang Keluar: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Barang Keluars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="barang-keluar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
