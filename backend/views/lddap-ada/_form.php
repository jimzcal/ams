<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LddapAda */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lddap-ada-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lddap_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dv_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'current_account')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uacs_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'net_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
