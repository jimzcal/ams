<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountingEntrySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accounting-entry-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'dv_no') ?>

    <?= $form->field($model, 'account_title') ?>

    <?= $form->field($model, 'uacs_code') ?>

    <?= $form->field($model, 'debit') ?>

    <?php // echo $form->field($model, 'credit_amount') ?>

    <?php // echo $form->field($model, 'credit_to') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
