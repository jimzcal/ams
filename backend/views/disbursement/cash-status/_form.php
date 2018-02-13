<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Transaction;
use backend\models\Disbursement;
use backend\models\AccountingEntry;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $model backend\models\CashStatus */

$this->title = 'CASH STATUS';
// $this->params['breadcrumbs'][] = ['label' => 'Cash Statuses', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>

<script>
    // if (document.readyState === 'complete') {
    //     alert('ccc')
    //     $(document).on("change", "select[id='type']", function () {     
    //         alert('xxx');   
    //         // $modal = $('#myModal');
    //         // if($(this).val() == 'Paid'){
    //         //     $modal.modal('show');
    //         // }
    //     });
    // }
</script>

<div class="cash-status-create">
    <?= Yii::$app->session->getFlash('error'); ?>
    <div class="row">
        <div class="title" style="margin-left: 10px;">
            <?= Html::encode($this->title) ?>
        </div>
    	<div class="col-lg-3">
    		<div class="form-wrapper">
    		    <?php $form = ActiveForm::begin(); ?>

                <label>NCA No.</label></br>
                <p><?= $model->nca ?></p>

                <label>Beginning Balance:</label></br>
                <p><?= number_format($model3->amount,2) ?></p>

                <label>Current Balance</label></br>
                <p><?= number_format($model3->amount - array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])->where(['nca'=>$model->nca])->andWhere(['obligated' => 'yes'])->all(), 'net_amount')), 2) ?></p>

                <label>Disbursement Amount:</label></br>
                <p><?= number_format($model->net_amount, 2) ?></p>

                <label>System Finding:</label></br>
                <p style="font-size: 14px"><?= ( ($model3->amount - array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])->where(['id'=>$model->id])->andWhere(['obligated' => 'yes'])->all(), 'net_amount'))) >= $model->net_amount) ? '<span style="color: green">WITH SUFFICIENT BALANCE</span>' : '<span style="color: red">WITHOUT SUFFICIENT BALANCE</span>' ?></p>

    		    <div class="form-group">
    		        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    		    </div>
    		</div>
    	</div>
    	<div class="col-lg-9">
    		<table class="table table-bordered">
                <tr>
                    <td><labe>DV NO.</labe></br><strong><?= isset($dv_no) ? $dv_no : $model->dv_no ?></strong></td>
                    <td colspan="1">
                        <label>Transaction-Type:</label></br>
                        <?php $trans = transaction::find()->where(['id'=>$model->transaction_id])->one(); echo $trans->name; ?>
                    </td>
                    <td width="160">
                        <label>Cash Advance?</label><br>
                        <?= $model->cash_advance ?>
                    </td>
                    <td>
                        <?= $form->field($model, 'status')->dropDownList([$model->status => $model->status, 'Unpaid'=>'Unpaid', 'Paid'=>'Paid', 'Cancelled'=>'Cancelled'], ['id' => 'type']) ?>
                    </td>
                    <td><label>NCA No.</label><br><?= $model->nca ?></td>
                    <td><label>Date:</label><br><?= $model->date ?></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <label>Payee:</label><br>
                        <?= $model->payee ?>
                    </td>
                    <td><label>Responsibility Center:</label><br><?= $model->responsibility_center ?></td>
                    <td><label>ORS No.</label></br><?= $model->ors_class.'-'.$model->ors_year.'-'.$model->ors_month.'-'.$model->ors_serial ?></td>
                </tr>
                <tr>
                    <td colspan="4"><label>Particulars</label><br><?= $model->particulars ?>
                    </td>
                    <td width="120"><label>MFO/PAP:</label><br><?= $model->mfo_pap ?><br>
                        <label>Less Amount:</label><br>
                        <?= number_format($model->less_amount, 2) ?>
                    </td>
                    <td><label>Gross Amount:</label><br><?= number_format($model->gross_amount, 2) ?><br>
                        <label>Net Amount:</label><br><?= number_format($model->net_amount, 2) ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <?= $form->field($model, 'remarks')->textarea(['rows' => 3, 'value' => $model->remarks]) ?>
                    </td>
                    <td></td>
                </tr>
            </table>
    	</div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
             <h4 class="modal-title">Update Disbursement Voucher</h4>
          </div>
          <div class="modal-body">
            <table width="500">
                <tr>
                    <td><?= $form->field($model, 'date_paid')->widget(DatePicker::classname(), [
                    'options' => ['value' => date('M. d, Y'), 'required' => 'required'],
                    'pluginOptions' => [
                    'autoclose'=>true,
                    'todayHighlight' => true,
                    'format' => 'M. d, yyyy'
                        ]
                    ]); 
                ?> </td>
                </tr>       
                <tr>
                    <td><?= $form->field($model, 'lddap_check_no')->textInput(['maxlength' => true, 'style' => 'width: 95%']) ?></td>
                </tr>
            </table>
          </div>
          <div class="modal-footer">
            <?= Html::submitButton('Ok', ['class' => 'btn btn-success btn-right']) ?>
          </div>
        </div>
      </div>
    </div>
	<?php ActiveForm::end(); ?>
</div>

<script>
    window.addEventListener("DOMContentLoaded", function() {
        $(document).on("change", "select[id='type']", function () { 
            // alert($(this).val())
            $modal = $('#myModal');
            if($(this).val() == 'Paid'){
                $modal.modal('show');
            }
        });
    }, false);
</script>