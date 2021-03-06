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

    <table class="search-table-long">
        <tr>
            <td valign="top" align="right">
                <i class="fa fa-search" style="color: green; font-size: 30px;"></i>
            </td>
            <td>
                <?= $form->field($model, 'dv_no')->textInput(['placeholder' => 'DV No.'])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'payee')->textInput(['placeholder' => 'Name of Payee'])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'date')->textInput(['placeholder' => 'Date of Transaction'])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'status')->dropDownList(['Received' => 'Received', 'Earmarked' => 'Earmarked', 'Approved' => 'Approved', 'Paid' => 'Paid', 'Cancelled' => 'Cancelled'], ['prompt' => 'Status'])->label(false) ?>
            </td>
            <td>
                <div class="form-group">
                    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                </div>
            </td>
        </tr>
    </table>

    <?php ActiveForm::end(); ?>

</div>
