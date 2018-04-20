<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ActivityLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'particular')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
