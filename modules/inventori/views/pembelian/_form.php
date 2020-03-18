<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\modules\inventori\models\DetailPembelian;
use backend\modules\inventori\models\Vendor;
use backend\modules\inventori\models\Barang;
use backend\modules\inventori\models\Pembelian;
use dosamigos\datepicker\DatePicker;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model backend\modules\inventori\models\Pembelian */
/* @var $form yii\widgets\ActiveForm */

$js = 
'jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-detail-pembelian").each(function(index) {
        jQuery(this).html("Detail Pembelian: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-detail-pembelian").each(function(index) {
        jQuery(this).html("Detail Pembelian: " + (index + 1))
    });
});
';
$this->registerJs($js);
?>

<div class="pembelian-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($modelPembelian, 'id')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($modelPembelian, 'kode')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($modelPembelian, 'tanggal')->widget(
            DatePicker::className(),[
                'inline' => false,
                'clientOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-m-d'
                ]
            ]
        ) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($modelPembelian, 'vendor_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Vendor::find()->all(),'id','nama'),
            'language' => 'en',
            'options' => ['placeholder' => 'Pilih Vendor'],
            'pluginOptions' => [
                'allowClear' => true],
            ]);
        ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($modelPembelian, 'total')->textInput() ?>
        </div>
    </div>

    <div class="padding-v-md">
        <div class="line line-dashed"></div>
    </div>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 10, // the maximum times, an element can be cloned (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsDetailPembelian[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'total',
            'qty',
            'barang_id',
            'harga',
            'deskripsi',
        ],
    ]); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope"></i> Detail Pembelian
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Add</button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items"><!-- widgetContainer -->
            <?php foreach ($modelsDetailPembelian as $index => $modelDetailPembelian): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <span class="panel-title-detail-pembelian">Detail Pembelian : <?= ($index + 1) ?></span>
                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (!$modelDetailPembelian->isNewRecord) {
                                echo Html::activeHiddenInput($modelDetailPembelian, "[{$index}]id");
                            }
                        ?>

                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelDetailPembelian, "[{$index}]deskripsi")->textInput() ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelDetailPembelian, "[{$index}]qty")->textInput() ?>
                            </div>
                        </div><!-- end:row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelDetailPembelian, "[{$index}]barang_id")->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(Barang::find()->all(),'id','nama'),
                                    'language' => 'en',
                                    'options' => ['placeholder' => 'Pilih Barang'],
                                    'pluginOptions' => [
                                        'allowClear' => true],
                                    ]);
                                ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelDetailPembelian, "[{$index}]harga")->widget(MaskMoney::classname(), [
                                    'pluginOptions' => [
                                        'prefix' => 'Rp ',
                                        'allowNegative' => false],
                                    ]);
                                ?>
                            </div>
                        </div><!-- end:row -->

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>

    <div class="form-group">
        <?= Html::submitButton($modelDetailPembelian->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

<script type="text/javascript" >

        function calculate(){
            
        }
</script>
</div>