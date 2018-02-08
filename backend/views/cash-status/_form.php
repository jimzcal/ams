<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CashStatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cash-status-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nca_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'current_balance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'disbursement_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'balance')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
