<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Ors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ors-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'particular')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ors_class')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'funding_source')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ors_year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ors_month')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ors_serial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mfo_pap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'responsibility_center')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
