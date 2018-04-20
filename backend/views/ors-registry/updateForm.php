<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OrsRegistry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ors-registry-form">

    <?php $form = ActiveForm::begin(); ?>

        <table class="table table-condensed table-striped table-bordered">
            <tr>
                <th>ORS No.</th>
                <th>MFO/PAP</th>
                <th>Responsibility Center</th>
                <th>Gross Amount</th>
                <th>Less Amount</th>
                <th>Net Amount</th>
            </tr>
            <?php foreach ($model_registry as $value) : ?>
            <tr>
                <td>
                    <?= $form->field($model, 'ors_no[]')->textInput(['maxlength' => true, 'value' => $value->ors_class.'-'.$value->funding_source.'-'.$value->ors_year.'-'.$value->ors_month.'-'.$value->ors_serial])->label(false) ?>
                </td>
                <td>
                    <?= $form->field($model, 'mfo_pap[]')->textInput(['maxlength' => true, 'value' => $value->mfo_pap])->label(false) ?>
                </td>
                <td>
                    <?= $form->field($model, 'responsibility_center[]')->textInput(['maxlength' => true, 'value' => $value->responsibility_center])->label(false) ?>
                </td>
                <td>
                    <?= $form->field($model, 'gross_amount[]')->textInput(['maxlength' => true, 'value' => $value->gross_amount])->label(false) ?>
                </td>
                <td>
                    <?= $form->field($model, 'less_amount[]')->textInput(['maxlength' => true, 'value' => $value->less_amount])->label(false) ?>
                </td>
                <td>
                    <?= $form->field($model, 'net_amount[]')->textInput(['maxlength' => true, 'value' => $value->net_amount])->label(false) ?>
                </td>
            </tr>
            <?= $form->field($model, 'id[]')->hiddenInput(['maxlength' => true, 'value' => $value->id])->label(false) ?>
            <?php endforeach ?>
        </table>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
