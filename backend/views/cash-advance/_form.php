<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\CashAdvance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cash-advance-form">

    <?php $form = ActiveForm::begin(); ?>

    <table class="table-condensed">
    	<tr style="vertical-align: top;">
    		<td style="width: 100px;">Date</td>
    		<td style="width: 10px;">:</td>
    		<td style="width: 400px;"><?= $form->field($model, 'date')->textInput(['maxlength' => true, 'readonly' => true])->label(false) ?></td>
    	</tr>
    	<tr style="vertical-align: top;">
    		<td>DV No.</td>
    		<td>:</td>
    		<td><?= $form->field($model, 'dv_no')->textInput(['maxlength' => true, 'readonly' => true])->label(false) ?></td>
    	</tr>
    	<tr style="vertical-align: top;">
    		<td>Payee</td>
    		<td>:</td>
    		<td><?= $form->field($model, 'name')->textInput(['maxlength' => true, 'value' => $model->dvNo->payee, 'readonly' => true])->label(false) ?></td>
    	</tr>
    	<tr style="vertical-align: top;">
    		<td>Amount</td>
    		<td>:</td>
    		<td><?= $form->field($model, 'amount')->textInput(['maxlength' => true, 'value' => number_format($model->dvNo->gross_amount - $model->dvNo->less_amount, 2)])->label(false) ?></td>
    	</tr>
    	<tr style="vertical-align: top;">
    		<td>Due Date</td>
    		<td>:</td>
    		<td style="vertical-align: top;"><?= $form->field($model, 'due_date')->widget(DatePicker::classname(), [
	                'options' => ['value' => $model->due_date != null ? $model->due_date : date('M. d, Y')],
	                'pluginOptions' => [
		                'todayHighlight' => true,
		                'format' => 'M. d, yyyy'
	                    ]
	                ])->label(false);
                ?>
    		</td>
    	</tr>
    	<tr style="vertical-align: top;">
    		<td>Status</td>
    		<td>:</td>
    		<td><?= $form->field($model, 'status')->dropDownList(['Liquidated'=>'Liquidated', 'Unliquidated'=>'Unliquidated'], ['id' => 'status'])->label(false) ?></td>
    	</tr>
    	<tr style="vertical-align: top; display: none; height: 20px;" id="payment_method">
    		<td>Payment Method</td>
    		<td>:</td>
    		<td>
    			<input type="radio" name="payment_method" value="Partial" id="method" onclick="partialFunction()">
    			<label>Partial Payment</label> 
    			<input type="radio" name="payment_method" id="methods" value="Full" onclick="myFunction()">
    			<label>Full Payment</label>
    		</td>
    	</tr>
    	<tr style="height: 16px;">
    		<td colspan="3"></td>
    	</tr>
    	<tr style="vertical-align: top; display: none;" id="payment_amount">
    		<td>Liquidation Amount</td>
    		<td style="width: 10px;">:</td>
    		<td><?= $form->field($model, 'amount_paid')->textInput(['maxlength' => true, 'id' => 'amount'])->label(false) ?></td>
    	</tr>
    </table>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<script>

window.onload = function()
{
	$(document).on("change", "select[id='status']", function () 
	{ 
        // alert($(this).val())
        //$modal = $('#payment');
        if($(this).val() == 'Liquidated'){
            $('#payment_method').show();
            $('#payment_amount').show();
        }
        if($(this).val() == 'Unliquidated'){
            $('#payment_method').hide();
            $('#payment_amount').hide();
        }
    });

}

function myFunction() 
{
    var val = document.getElementById("methods").value;
    if(val == 'Full')
    {
    	document.getElementById("amount").value = <?= number_format(($model->dvNo->gross_amount - $model->dvNo->less_amount), 2) ?>;
    }
    else
    {
    	document.getElementById("amount").value = 0.00;
    }  
}

function partialFunction() 
{
    var val = document.getElementById("method").value;
    if(val == 'Partial')
    {
    	document.getElementById("amount").value = '0.00';
    } 
}
</script>
