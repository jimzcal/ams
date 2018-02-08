<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Transaction;
use backend\models\Disbursement;
use backend\models\AccountingEntry;
use backend\models\CashStatus;


/* @var $this yii\web\View */
/* @var $model backend\models\CashStatus */

$this->title = 'CASH STATUS';
// $this->params['breadcrumbs'][] = ['label' => 'Cash Statuses', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="cash-status-create">
    <?= Yii::$app->session->getFlash('error'); ?>
	<div class="col-lg-3">
		<div class="title">
			<?= Html::encode($this->title) ?>
		</div>
		<div class="form-wrapper">
		    <?php $form = ActiveForm::begin(); ?>

		    <?= $form->field($model, 'nca_no')->textInput(['maxlength' => true, 'value' => $model2->nca, 'readonly' => true]) ?>

		    <?= $form->field($model, 'dv_no')->hiddenInput(['maxlength' => true, 'value' => $model2->dv_no])->label(false) ?>

		    <?= $form->field($model, 'beginning_balance')->textInput(['value' => $model3->amount, 'readonly' => true]) ?>

		    <?= $form->field($model, 'current_balance')->textInput(['maxlength' => true, 'value' => ($c_bal = $model3->amount - array_sum(ArrayHelper::getColumn(CashStatus::find(['amount'])->where(['nca_no'=>$model2->nca])->all(), 'disbursement_amount')))]) ?>

		    <?= $form->field($model, 'disbursement_amount')->textInput(['maxlength' => true, 'value' => $model2->net_amount]) ?>

		    <?= $form->field($model, 'balance')->textInput(['maxlength' => true, 'value' => ($bal = ($c_bal - $model2->net_amount))]) ?>

		    <div class="form-group">
		        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
		    </div>
		</div>
	</div>
	<div class="col-lg-9">
		<table class="table table-striped">
            <tr>
                <label>System Finding:</label>
                <td style="font-size: 22px"><?= ($c_bal >= $model2->net_amount) ? '<span style="color: green">WITH SUFFICIENT BALANCE</span>' : '<span style="color: red">WITHOUT SUFFICIENT BALANCE</span>' ?></td>
            </tr>
        </table>
		<table class="table table-bordered">
            <tr>
                <td><labe>DV NO.</labe></br><strong><?= isset($dv_no) ? $dv_no : $model2->dv_no ?></strong></td>
                <td colspan="1">
                    <label>Transaction-Type:</label></br>
                    <?php $trans = transaction::find()->where(['id'=>$model2->transaction_id])->one(); echo $trans->name; ?>
                </td>
                <td width="160">
                    <label>Cash Advance?</label></br>
                    <?= $model2->cash_advance ?>
                </td>
                <td><label>NCA No.</label></br><?= $model2->nca ?></td>
                <td><label>Date:</label></br><?= $model2->date ?></td>
            </tr>
            <tr>
                <td colspan="3">
                    <label>Payee:</label></br>
                    <?= $model2->payee ?>
                </td>
                <td><label>Responsibility Center:</label></br><?= $model2->responsibility_center ?></td>
                <td><label>ORS No.</label></br><?= $model2->ors_no ?></td>
            </tr>
            <tr>
                <td colspan="3"><label>Particulars</label></br><?= $model2->particulars ?>
                </td>
                <td width="120"><label>MFO/PAP:</label></br><?= $model2->mfo_pap ?></br>
                    <label>Less Amount:</label></br>
                    <?= number_format($model2->less_amount, 2) ?>
                </td>
                <td><label>Gross Amount:</label></br><?= number_format($model2->gross_amount, 2) ?></br>
                    <label>Net Amount:</label></br><?= number_format($model2->net_amount, 2) ?>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                	<?= $form->field($model, 'remarks')->textarea(['rows' => 3, 'value' => $model2->remarks]) ?>
                </td>
            </tr>
        </table>
	</div>
	<?php ActiveForm::end(); ?>
</div>
