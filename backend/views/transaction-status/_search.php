<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TransactionStatusSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-status-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'dv_no') ?>

    <?= $form->field($model, 'receiving') ?>

    <?= $form->field($model, 'processing') ?>

    <?= $form->field($model, 'nca_control') ?>

    <?php // echo $form->field($model, 'verification') ?>

    <?php // echo $form->field($model, 'lddap_ada') ?>

    <?php // echo $form->field($model, 'releasing') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
