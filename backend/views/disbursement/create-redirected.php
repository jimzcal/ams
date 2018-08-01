<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;



/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */

$this->title = 'NEW DISBURSEMENT VOUCHER';
// $this->params['breadcrumbs'][] = ['label' => 'Disbursements', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="disbursement-create">
	<div style="margin-left: auto; margin-right: auto; width: 30%; margin-top: 100px; padding: 10px;">
		<?php $form = ActiveForm::begin(); ?> 
			<div>
				<table style="margin-left: auto; margin-right: auto;">
					<tr>
						<td>
							<input type="radio" id="ref-select" name="selection" value="1" checked="checked">
							<label>With rerefence No.</label>
						</td>
						<td>
							<input type="radio" id="ref-select" name="selection" value="0">
							<label>No rerefence No.</label>
						</td>
					</tr>
					<tr style="height: 60px;">
						<td colspan="2">
							<?= Select2::widget([
							    'name' => 'reference_no',
							    'value' => '',
							    'data' => $data,
							    'options' => ['multiple' => false, 'placeholder' => 'Enter Reference No.']
							]); ?>
						</td>
					</tr>
					<tr style="height: 90px; text-align: center;">
						<td colspan="2">
							<div class="form-group">
					          	<?= Html::submitButton('Proceed', ['class' => 'btn btn-success']) ?>
					      	</div>
						</td>
					</tr>
				</table>
				
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</div>

<script>
window.onload = function()
{
	$("input[id='ref-select']").click(function () 
	{

		if($(this).val() == '1') 
        {
            $('#field1').show();
        }

        if($(this).val() == '0') 
        {
            $('#field1').hide();
        }

    });
}
</script>
