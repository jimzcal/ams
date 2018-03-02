<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Transaction;
use backend\models\Disbursement;
use backend\models\AccountingEntry;
use kartik\date\DatePicker;
use backend\models\FundCluster;
use backend\models\Nca;


/* @var $this yii\web\View */
/* @var $model backend\models\CashStatus */

$this->title = 'CASH STATUS';
// $this->params['breadcrumbs'][] = ['label' => 'Cash Statuses', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="cash-status-create">
    <?= Yii::$app->session->getFlash('error'); ?>
    <div class="form-wrapper">
        <div class="row">
        	<div class="col-lg-3">
                <div class="title" style="margin-left: 10px;">
                    <?= Html::encode($this->title) ?>
                </div>
        		<div class="form-wrapper-left">
        		    <?php $form = ActiveForm::begin(); ?>

                    <label>NCA No.:</label><br>
                    <p><?= $model->nca ?></p>

                    <label>Allotment:</label><br>
                    <p><?= number_format($model3->total_amount,2) ?></p>

                    <label>Monthly Allotment for <?php $val = explode(' ', $model->date); echo $val[0].':'; ?></label><br>
                        <p>
                            <?php 
                                switch(strtolower($val[0]))
                                {
                                    case 'january':
                                    echo number_format($model3->january, 2);
                                    break;
                                
                                    case 'february':
                                    echo number_format($model3->february, 2);
                                    break;
                               
                                    case 'march':
                                    echo number_format($model3->march, 2);
                                    break;
                               
                                    case 'april':
                                    echo number_format($model3->april, 2);
                                    break;
                               
                                    case 'may':
                                    echo number_format($model3->may, 2);
                                    break;
                               
                                    case 'june':
                                    echo number_format($model3->june, 2);
                                    break;
                                
                                    case 'july':
                                    echo number_format($model3->july, 2);
                                    break;
                                
                                    case 'august':
                                    echo number_format($model3->august, 2);
                                    break;
                                
                                    case 'september':
                                    echo number_format($model3->september, 2);
                                    break;
                                
                                    case 'october':
                                    echo number_format($model3->october, 2);
                                    break;
                                
                                    case 'november':
                                    echo number_format($model3->november, 2);
                                    break;
                                
                                    case 'december':
                                    echo number_format($model3->december, 2);
                                    break;
                                
                                    default:
                                    echo 0.00;
                                }
                            ?>
                        </p>

                    <label>Current Balance for <?= $val[0].':' ?></label><br>
                        <p>
                            <?php 
                                switch(strtolower($val[0]))
                                {
                                    case 'january':
                                    $bal = $model3->january - array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['nca'=>$model->nca])
                                        ->andWhere(['obligated' => 'yes'])
                                        ->andWhere(['like', 'date', 'January'])
                                        ->all(), 'net_amount')); 

                                    echo number_format($bal, 2);
                                    break;
                                
                                    case 'february':
                                    $bal = $model3->february - array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['nca'=>$model->nca])
                                        ->andWhere(['obligated' => 'yes'])
                                        ->andWhere(['like', 'date', 'February'])
                                        ->all(), 'net_amount'));

                                    echo number_format($bal, 2);
                                    break;
                               
                                    case 'march':
                                    $bal = $model3->march - array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['nca'=>$model->nca])
                                        ->andWhere(['obligated' => 'yes'])
                                        ->andWhere(['like', 'date', 'March'])
                                        ->all(), 'net_amount'));

                                    echo number_format($bal, 2);
                                    break;
                               
                                    case 'april':
                                    $bal = $model3->april - array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['nca'=>$model->nca])
                                        ->andWhere(['obligated' => 'yes'])
                                        ->andWhere(['like', 'date', 'April'])
                                        ->all(), 'net_amount'));

                                    echo number_format($bal, 2);
                                    break;
                               
                                    case 'may':
                                    $bal = $model3->may - array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['nca'=>$model->nca])
                                        ->andWhere(['obligated' => 'yes'])
                                        ->andWhere(['like', 'date', 'May'])
                                        ->all(), 'net_amount'));

                                    echo number_format($bal, 2);
                                    break;
                               
                                    case 'june':
                                    $bal = $model3->june - array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['nca'=>$model->nca])
                                        ->andWhere(['obligated' => 'yes'])
                                        ->andWhere(['like', 'date', 'June'])
                                        ->all(), 'net_amount'));

                                    echo number_format($bal, 2);
                                    break;
                                
                                    case 'july':
                                    $bal = $model3->july - array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['nca'=>$model->nca])
                                        ->andWhere(['obligated' => 'yes'])
                                        ->andWhere(['like', 'date', 'July'])
                                        ->all(), 'net_amount'));

                                    echo number_format($bal, 2);
                                    break;
                                
                                    case 'august':
                                    $bal = $model3->august - array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['nca'=>$model->nca])
                                        ->andWhere(['obligated' => 'yes'])
                                        ->andWhere(['like', 'date', 'August'])
                                        ->all(), 'net_amount'));

                                    echo number_format($bal, 2);
                                    break;
                                
                                    case 'september':
                                    $bal = $model3->september - array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['nca'=>$model->nca])
                                        ->andWhere(['obligated' => 'yes'])
                                        ->andWhere(['like', 'date', 'September'])
                                        ->all(), 'net_amount'));

                                    echo number_format($bal, 2);
                                    break;
                                
                                    case 'october':
                                    $bal = $model3->october - array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['nca'=>$model->nca])
                                        ->andWhere(['obligated' => 'yes'])
                                        ->andWhere(['like', 'date', 'October'])
                                        ->all(), 'net_amount'));

                                    echo number_format($bal, 2);
                                    break;
                                
                                    case 'november':
                                    $bal = $model3->november - array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['nca'=>$model->nca])
                                        ->andWhere(['obligated' => 'yes'])
                                        ->andWhere(['like', 'date', 'November'])
                                        ->all(), 'net_amount'));

                                    echo number_format($bal, 2);
                                    break;
                                
                                    case 'december':
                                    $bal = $model3->december - array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['nca'=>$model->nca])
                                        ->andWhere(['obligated' => 'yes'])
                                        ->andWhere(['like', 'date', 'December'])
                                        ->all(), 'net_amount'));

                                    echo number_format($bal, 2);
                                    break;
                                
                                    default:
                                    echo "Something's wrong!";
                                }
                            ?>
                        </p>

                    <label>Disbursement Amount:</label></br>
                    <p><?= number_format($model->net_amount, 2) ?> <?= $model->obligated === 'yes' ? '(obligated)' : '' ?></p>

                    <label>System Finding:</label></br>
                    <p style="font-size: 14px">
                        <?php if($model->obligated === 'yes') 
                        {
                            echo ($bal + $model->net_amount) >= $model->net_amount ? '<span style="color: green">WITH SUFFICIENT BALANCE</span>' : '<span style="color: red">WITHOUT SUFFICIENT BALANCE</span>';
                            $x = ($bal + $model->net_amount) >= $model->net_amount ? 'false': 'true';
                        }
                        else {
                           echo $bal >= $model->net_amount ? '<span style="color: green">WITH SUFFICIENT BALANCE</span>' : '<span style="color: red">WITHOUT SUFFICIENT BALANCE</span>';
                           $x = $bal >= $model->net_amount ? 'false': 'true';
                        }
                        ?></p>

        		    <div class="form-group">
        		        <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'disabled' => $x === 'false' ? false : true ]) ?>
                        <?= Html::a('Close', ['/disbursement/disbursements', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        		    </div>
        		</div>
        	</div>
        	<div class="col-lg-9">
                <!-- <?= $this->render('/transaction-status/transaction_status') ?> -->
                <div class="title">DISBURSEMENT VOUCHER</div>
        		<table class="table table-bordered">
                    <tr>
                        <td>
                            <label>DV NO.</label><br>
                            <strong><?= isset($dv_no) ? $dv_no : $model->dv_no ?></strong>
                        </td>
                        <td>
                            <label>Transaction-Type:</label></br>
                            <?php $trans = transaction::find()->where(['id'=>$model->transaction_id])->one(); echo $trans->name; ?>
                        </td>
                        
                        <td colspan="3">
                            <?= $form->field($model, 'status')->dropDownList([$model->status => $model->status, 'Unpaid'=>'Unpaid', 'Paid'=>'Paid', 'Cancelled'=>'Cancelled'], ['id' => 'type']) ?>
                        </td>
                        <td width="200">
                            <label>Date:</label><br>
                            <?= $model->date ?>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4">
                            <label>Payee:</label><br>
                            <?= $model->payee ?>
                        </td>
                        <td width="200">
                            <label>Fund Cluster:</label><br>
                            <?= $form->field($model, 'fund_cluster')->dropDownList(ArrayHelper::map(FundCluster::find()->all(),'fund_cluster','fund_cluster'),
                            [
                                // 'prompt'=>'Select Fund Cluster',
                                'onchange'=>'
                                     $.post("index.php?r=nca/clusters&fund_cluster='.'"+$(this).val(),function(data){
                                        $("select#disbursement-nca").html(data);
                                    });'
                            ])->label(false) ?>
                        </td>
                        <td>
                            <label>NCA No.:</label></br>
                            <?= $form->field($model, 'nca')->dropDownList(ArrayHelper::map(Nca::find()->all(),'nca_no', 'nca_no'))->label(false) ?>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="6">
                            <table class="table table-condensed">
                                    <tr>
                                        <th>Particulars</th>
                                        <th>ORS No</th>
                                        <th>MFO/PAP</th>
                                        <th>Responsibility Center</th>
                                        <th>Amount</th>
                                    </tr>
                                    <?php foreach ($ors_model as $value): ?>
                                        <tr>
                                            <td style="width: 250px;">
                                                <?= $value->particular ?>
                                            </td>
                                            <td style="width: 130px;">
                                                <?= $value->ors_class.'-'.$value->ors_year.'-'.$value->ors_month.'-'.$value->ors_serial ?>
                                            </td>
                                            <td>
                                                <?= $value->mfo_pap ?>
                                            </td>
                                            <td>
                                                <?= $value->responsibility_center ?>
                                            </td>
                                            <td style="width: 100px;">
                                                <?= $value->amount ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </table>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4">
                            <?= $form->field($model, 'remarks')->textarea(['rows' => 3, 'value' => $model->remarks]) ?>
                        </td>
                        <td width="120">
                            <label>Gross Amount:</label><br>
                            <?= number_format($model->gross_amount, 2) ?><br>
                        </td>
                        <td>
                            <label>Less Amount:</label><br>
                            <?= number_format($model->less_amount, 2) ?><br>
                            <label>Net Amount:</label><br>
                            <span style="font-size: 20px"><?= number_format($model->net_amount, 2) ?></span>
                        </td>
                    </tr>
                </table>
        	</div>
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
            <?= Html::submitButton('Ok', ['class' => 'btn btn-success']) ?>
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