<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\modules\inventori\models\Satuan;
use backend\modules\inventori\models\Merk;

/* @var $this yii\web\View */
/* @var $model backend\modules\inventori\models\Barang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="barang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'satuan_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Satuan::find()->all(),'id','nama'),
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Satuan'],
        'pluginOptions' => [
            'allowClear' => true],
        ]);
    ?>

    <?= $form->field($model, 'merk_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Merk::find()->all(),'id','nama'),
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Barang'],
        'pluginOptions' => [
            'allowClear' => true],
        ]);
    ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
