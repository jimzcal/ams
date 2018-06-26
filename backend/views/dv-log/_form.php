<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DvLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dv-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->hiddenInput(['value' => date('yyyy-m-d')])->label(false) ?>

    <?= $form->field($model, 'transaction')->hiddenInput(['maxlength' => true, 'value' => 'Forward'])->label(false) ?>

    <input type="radio" name="selection" id="status" value="id">
    <label>ID</label>

    <input type="radio" name="selection" id="status" value="bio">
    <label>Biometrics</label>

    <input type="radio" name="selection" id="status" value="qr">
    <label>QR Code</label>


	<?= $form->field($model, 'employee_id')->textInput(['maxlength' => true, 'id' => 'id']) ?>

	<?= $form->field($model, 'biometrix')->textInput(['maxlength' => true, 'id' => 'bio']) ?>

	<?= $form->field($model, 'qr_code')->textInput(['maxlength' => true, 'id' => 'qr']) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>

window.onload = function()
{
	$(document).on("change", "select[id='status']", function () 
	{ 
        // alert($(this).val())
        //$modal = $('#payment');
        if($(this).val() == 'id'){
            $('#id').show();
            $('#bio').hide();
            $('#qr').hide();
        }

        if($(this).val() == 'bio'){
            $('#bio').show();
            $('#id').hide();
            $('#qr').hide();
        }

        if($(this).val() == 'qr'){
            $('#qr').show();
            $('#bio').hide();
            $('#id').hide();
        }
    });

}

</script>
