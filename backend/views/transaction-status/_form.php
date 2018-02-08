<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TransactionStatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-status-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dv_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'receiving')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'processing')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nca_control')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'verification')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'lddap_ada')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'releasing')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
