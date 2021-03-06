<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CashAdvanceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cash-advance-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <table class="search-table">
        <tr>
            <td valign="top" align="right">
                <i class="fa fa-search" style="color: green; font-size: 30px;"></i>
            </td>
            <td>
                <?= $form->field($model, 'dv_no')->textInput(['placeholder' => 'DV No.'])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'status')->dropDownList(['Unliquidated' => 'Unliquidated', 'Liquidated'=>'Liquidated'])->label(false) ?>
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
