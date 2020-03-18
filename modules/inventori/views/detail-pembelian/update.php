<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\inventori\models\DetailPembelian */

$this->title = 'Update Detail Pembelian: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Detail Pembelians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="detail-pembelian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
