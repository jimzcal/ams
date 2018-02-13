<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DisbursedDv */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="disbursed-dv-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dv_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_paid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lddap_check_no')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
