<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\NcaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nca-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date_received') ?>

    <?= $form->field($model, 'nca_no') ?>

    <?= $form->field($model, 'fund_cluster') ?>

    <?= $form->field($model, 'mds_sub_acc_no') ?>

    <?php // echo $form->field($model, 'gsb_branch') ?>

    <?php // echo $form->field($model, 'purpose') ?>

    <?php // echo $form->field($model, 'fiscal_year') ?>

    <?php // echo $form->field($model, 'january') ?>

    <?php // echo $form->field($model, 'february') ?>

    <?php // echo $form->field($model, 'march') ?>

    <?php // echo $form->field($model, 'april') ?>

    <?php // echo $form->field($model, 'may') ?>

    <?php // echo $form->field($model, 'june') ?>

    <?php // echo $form->field($model, 'july') ?>

    <?php // echo $form->field($model, 'august') ?>

    <?php // echo $form->field($model, 'september') ?>

    <?php // echo $form->field($model, 'october') ?>

    <?php // echo $form->field($model, 'november') ?>

    <?php // echo $form->field($model, 'december') ?>

    <?php // echo $form->field($model, 'total_amount') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
