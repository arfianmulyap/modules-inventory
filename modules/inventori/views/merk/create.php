<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\inventori\models\Merk */

$this->title = 'Create Merk';
$this->params['breadcrumbs'][] = ['label' => 'Merks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
