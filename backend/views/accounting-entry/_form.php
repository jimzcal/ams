<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountingEntry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accounting-entry-form">

    <?php $form = ActiveForm::begin(); ?>
            <table class="table table-bordered">
                <tr>
                    <td align="center">VAT</td><td align="center">ACCOUNT TITLE</td><td align="center">UACS CODE</td><td align="center">DEBIT</td><td align="center">CREDIT AMOUNT</td><td align="center">CREDIT TO</td>
                </tr>
                <?php foreach ($entry as $value) : ?>
                <tr>
                    <td align="center">
                        <?= $value->vat == '1' ? '12%' : '' ?>
                    </td>
                    <td>
                        <?= $value->account_title ?>
                    </td>
                    <td>
                        <?= $value->uacs_code ?>
                    </td>
                    <td width="150">
                        <?= $value->debit ?>
                    </td>
                    <td width="100">
                        <?= $value->credit_amount ?>
                    </td>
                    <td width="250">
                        <?= $value->credit_to ?>
                    </td>
                </tr>
                <?php endforeach ?>
                <tr>
                    <?= $form->field($model, 'dv_no')->hiddenInput(['maxlength' => true, 'value' => empty($dv_no) ? $model->dv_no : $dv_no, 'readonly'=>true])->label(false) ?>
                    <td align="center">
                        <?= $form->field($model, 'vat')->checkbox(['label' => false, 'value' => 1]) ?>
                    </td>
                    <td>
                        <?= $form->field($model, 'account_title')->textInput(['maxlength' => true])->label(false) ?>
                    </td>
                    <td>
                        <?= $form->field($model, 'uacs_code')->textInput(['maxlength' => true])->label(false) ?>
                    </td>
                    <td width="150">
                        <?= $form->field($model, 'debit')->textInput(['value' => empty($model->debit) ? $gross : $model->debit])->label(false) ?>
                    </td>
                    <td width="100">
                        <?= $form->field($model, 'credit_amount')->dropDownList(['0'=>'No Deduction','5'=>'5%', '10'=>'10%', '3'=>'3%', $net => $net])->label(false)?>
                    </td>
                    <td width="250">
                        <?= $form->field($model, 'credit_to')->dropDownList([''=>'', 'BIR' => 'BIR', 'payee' => 'Payee' ])->label(false); ?>
                    </td>
                </tr>
            </table>
            <div class="modal-footer">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>
    <?php ActiveForm::end(); ?>

</div>
