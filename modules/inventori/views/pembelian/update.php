<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\inventori\models\Pembelian */

$this->title = 'Update Pembelian: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pembelians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pembelian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
       'modelPembelian' => $modelPembelian,
       'modelsDetailPembelian' => $modelsDdetailPembelian,
    ]) ?>

</div>
