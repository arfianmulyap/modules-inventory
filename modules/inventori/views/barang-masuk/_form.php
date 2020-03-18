<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\modules\inventori\models\Barang;
use backend\modules\inventori\models\Gudang;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\modules\inventori\models\BarangMasuk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="barang-masuk-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'barang_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Barang::find()->all(),'id','nama'),
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Barang'],
        'pluginOptions' => [
            'allowClear' => true],
        ]);
    ?>

    <?= $form->field($model, 'gudang_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Gudang::find()->all(),'id','nama'),
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Gudang'],
        'pluginOptions' => [
            'allowClear' => true],
        ]);
    ?>

    <?= $form->field($model, 'harga_perolehan')->textInput() ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <?= $form->field($model, 'deskripsi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nomor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal')->widget(
        DatePicker::className(),[
            'inline' => false,
            'clientOptions' => [
                'autoclose' => true,
                'todayHighlight' => true,
                'format' => 'yyyy-m-d'
            ]
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
