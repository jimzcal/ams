<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DisbursementSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="disbursement-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'dv_no') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'payee') ?>

    <?= $form->field($model, 'particulars') ?>

    <?php // echo $form->field($model, 'mode_of_payment') ?>

    <?php // echo $form->field($model, 'responsibility_center') ?>

    <?php // echo $form->field($model, 'mfo_pap') ?>

    <?php // echo $form->field($model, 'gross_amount') ?>

    <?php // echo $form->field($model, 'less_amount') ?>

    <?php // echo $form->field($model, 'net_amount') ?>

    <?php // echo $form->field($model, 'fund_source') ?>

    <?php // echo $form->field($model, 'ors_no') ?>

    <?php // echo $form->field($model, 'transaction_type') ?>

    <?php // echo $form->field($model, 'attachments') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
