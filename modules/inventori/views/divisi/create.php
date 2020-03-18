<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\inventori\models\Divisi */

$this->title = 'Create Divisi';
$this->params['breadcrumbs'][] = ['label' => 'Divisis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="divisi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
