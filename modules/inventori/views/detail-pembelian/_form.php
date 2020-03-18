<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\modules\inventori\models\Pembelian;
use backend\modules\inventori\models\Barang;
use dosamigos\datepicker\DatePicker;

?>

<div class="detail-pembelian-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <?= $form->field($model, 'harga')->textInput() ?>

    <?= $form->field($model, 'deskripsi')->textInput() ?>

    <?= $form->field($model, 'pembelian_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Pembelian::find()->all(),'id','kode'),
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Vendor'],
        'pluginOptions' => [
            'allowClear' => true],
        ]);
    ?>

    <?= $form->field($model, 'barang_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Barang::find()->all(),'id','nama'),
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Barang'],
        'pluginOptions' => [
            'allowClear' => true],
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
