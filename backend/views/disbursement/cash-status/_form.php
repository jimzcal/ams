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
use dosamigos\chartjs\ChartJs;
use yii\web\JsExpression;
use miloschuman\highcharts\Highcharts;
use backend\models\Ors;


/* @var $this yii\web\View */
/* @var $model backend\models\CashStatus */

$this->title = 'CASH STATUS';
// $this->params['breadcrumbs'][] = ['label' => 'Cash Statuses', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="cash-status-create">
<?php $form = ActiveForm::begin(); ?>
<?= Yii::$app->session->getFlash('error'); ?>

   <div class="view-index">
        <?php 

            $total_earmarked = array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                ->where(['nca'=>$model->nca])
                                ->andWhere(['obligated' => 'yes'])
                                ->all(), 'net_amount'));

            $total_nca_amount = array_sum(ArrayHelper::getColumn(Nca::find()
                                ->where(['nca_no'=>$model->nca])
                                ->all(), 'sub_total'));

            $total_earmarked_funding = array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                ->where(['nca'=>$model->nca])
                                ->andWhere(['obligated' => 'yes'])
                                ->andWhere(['funding_source' => $model3->funding_source])
                                ->all(), 'net_amount'));
        ?>
        <?= Highcharts::widget([
            'options' => [
                'chart' => ['type' => 'bar'],
               'title' => ['text' => 'Cash Status Graph per NCA '.'<br>'.'as of '.date('M. d, Y')],
               'xAxis' => [
                  'categories' => ['Allotment/Earmarked']
               ],
               'yAxis' => [
                  'title' => ['text' => 'Earmarked']
               ],
               'series' => [
                  ['name' => 'Allotment', 'data' => [(int)$total_nca_amount]],
                  ['name' => 'Earmarked', 'data' => [(int)$total_earmarked]]
               ]
            ]
    ]); ?> 
    </div>

    <div class="view-index">
        <div class="mini-header">
            <i class="fa fa-bar-chart-o" aria-hidden="true"></i> Monthly Cash Status per Funding Source
        </div>

        <table class="table table-bordered">
            <!-- <tr>
                <th>NCA No.</th>
                <th>Total Allotment</th>
                <th>Allotment for <?php $val = explode(' ', $model->date); echo $val[0]; ?></th>
                <th>
                    Current Balance for <?= $val[0] ?>
                </th>
                <th>
                    Disbursement Amount
                </th>
            </tr>
            <tr>
                <td><?= $model->nca ?></td>
                <td><?= number_format($model3->total_amount,2) ?></td>
                <td>
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
                </td>
                <td>
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
                </td>
                <td>
                    <?= number_format($total_earmarked, 2) ?> <?= $model->obligated === 'yes' ? '(earmarked)' : '' ?>
                </td>
            </tr> -->
            <tr>
                <th>NCA No</th>
                <th>Funding Source</th>
                <th>Validity</th>
                <th>Sub-total Allocation</th>
                <th>Total Earmarked</th>
                <th>Current Balance</th>
            </tr>
            <tr>
                <td><?= $model3->nca_no ?></td>
                <td><?= $model3->funding_source ?></td>
                <td><?= $model3->validity ?></td>
                <td><?= number_format($model3->sub_total, 2) ?></td>
                <td><?= number_format($total_earmarked_funding, 2) ?></td>
                <td><?= number_format($model3->sub_total-$total_earmarked_funding, 2) ?></td>
            </tr>
            <tr>
                <td colspan="6">
                    <label>System Findings:</label><br>
                    <?php 
                        $first_finding = '';
                        $second_finding = '';
                        $date = strtotime($model->date);
                        $date = date('F', $date);
                        $disability = 2;
                        if(strstr($model3->validity, strtolower($date)) != null)
                        {
                            echo "<div style= 'color: green'><i class = 'glyphicon glyphicon-ok'></i> Within the validity Period of the NCA</div>";
                            $first_finding = 'filled';
                        }
                        if($model->net_amount <= $model3->sub_total-$total_earmarked_funding)
                        {
                            echo "<div style= 'color: green'>
                                    <i class = 'glyphicon glyphicon-ok'></i> With Sufficient Fund</div>";
                            $second_finding  = 'filled';
                        }
                        if($first_finding == '')
                        {
                            echo "<div style= 'color: red'><i class = 'glyphicon glyphicon-remove'></i> Not Within the validity Period of the NCA</div>";
                        }
                        if($second_finding == '')
                        {
                            echo "<div style= 'color: red'>
                            <i class = 'glyphicon glyphicon-remove'></i> Without Sufficient Fund</div>";
                        }
                        if(empty($first_finding) || empty($second_finding))
                        {
                           $disability = 1;
                        }
                    ?>
                </td>
            </tr>
        </table>
    </div>

    <div class="view-index">
        <div class="mini-header">
            <i class="fa fa-id-card" aria-hidden="true"></i> Disbursement Voucher
        </div>

        <table class="table table-condensed">
            <tr>
                <td style="font-weight: bold; font-size: 18px;" colspan="3">DV No.
                    <?= isset($dv_no) ? $dv_no : $model->dv_no ?>
                </td>
                <td style="font-size: 18px; text-align: right; font-weight: bold;" colspan="3">
                    <?= $model->date===null ? date('M. d, Y') : $model->date ?>
                    <?= $form->field($model, 'date')->hiddenInput(['value' => $model->date===null ? date('M. d, Y') : $model->date, 'readonly' =>true])->label(false) ?>
                </td>
            </tr>
            <tr>
                <td style="text-align: right; font-weight: bold;">Payee :</td>
                <td colspan="3">
                    <?= $form->field($model, 'payee')->textInput(['maxlength' => true, 'id'=>'four', 'autofocus' => 'autofocus'])->label(false) ?>
                </td>
                <td style="text-align: right; font-weight: bold;">Status :</td>
                <td>
                    <?= $form->field($model, 'status')->dropDownList([$model->status => $model->status, 'Unpaid'=>'Unpaid', 'Paid'=>'Paid', 'Cancelled'=>'Cancelled'], ['id' => 'type'])->label(false) ?>
                </td>
            </tr>
            <tr>
                <td style="text-align: right; font-weight: bold;">Transaction Type :</td>
                <td colspan="3">
                    <?= $form->field($model, 'transaction_id')->dropDownList(ArrayHelper::map(transaction::find()->all(),'id', 'name'), ['prompt' => 'Select Transaction Type'])->label(false) ?>
                </td>
                <td style="text-align: right; font-weight: bold;">Mode of payment :</td>
                <td>
                    <?= $form->field($model, 'mode_of_payment')->dropDownList(['mds_check'=>'MDS Check', 'commercial_check'=>'Commercial Check', 'lldap_ada'=>'LLDAP-ADA'])->label(false) ?>
                </td>
            </tr>
            <tr>
                <td style="text-align: right; font-weight: bold;">Fund Cluster :</td>
                <td colspan="2">
                    <?= $form->field($model, 'fund_cluster')->dropDownList(ArrayHelper::map(FundCluster::find()->all(),'fund_cluster','fund_cluster'),
                     [
                        'onchange'=>'
                             $.post("'.Yii::$app->urlManager->createUrl('nca/clusters?fund_cluster=') . '"+$(this).val(),function(data){
                                $("select#disbursement-nca").html(data);
                            });'
                    ])->label(false); ?>
                </td>
                <td style="text-align: right; font-weight: bold;">Gross Amount :</td>
                <td colspan="2">
                    <?= $form->field($model, 'gross_amount')->textInput(['maxlength' => true, 'id'=>'nine'])->label(false) ?>
                </td>
            </tr>
            <tr>
                <td style="text-align: right; font-weight: bold;">NCA No. :</td>
                <td colspan="2">
                    <?= $form->field($model, 'nca')->dropDownList(ArrayHelper::map(Nca::find()->all(),'nca_no', 'nca_no'),
                        [
                            'prompt'=>'Select NCA No.',
                            'onchange'=>'
                                   $.post("'.Yii::$app->urlManager->createUrl('nca/sources?nca_no=') . '"+$(this).val(),function(data){
                                      $("select#disbursement-funding_source").html(data);
                                  });'
                    ])->label(false) ?>
                </td>
                <td style="text-align: right; font-weight: bold;">Less :</td>
                <td colspan="2">
                    <?= $form->field($model, 'less_amount')->textInput(['maxlength' => true, 'readonly'=>false, 'value'=> array_sum(ArrayHelper::getColumn(AccountingEntry::find(['credit_amount'])->where(['dv_no'=>$model->dv_no])->andWhere(['credit_to' => 'BIR'])->all(), 'credit_amount'))])->label(false) ?>
                </td>
            </tr>
            <tr>
                <td style="text-align: right; font-weight: bold;">Funding Source :</td>
                <td colspan="2">
                    <?= $form->field($model, 'funding_source')->dropDownList(ArrayHelper::map(Nca::find()->all(),'funding_source', 'funding_source'),
                        [
                          'prompt'=>'Select Funding Source',
                        ])->label(false);
                     ?>
                </td>
                <td style="text-align: right; font-weight: bold;">Net Amount :</td>
                <td colspan="2">
                    <?= $form->field($model, 'net_amount')->textInput(['maxlength' => true, 'readonly'=>false, 'value' => ($net_amount = $model->gross_amount - array_sum(ArrayHelper::getColumn(AccountingEntry::find(['credit_amount'])->where(['dv_no'=>$model->dv_no])->andWhere(['credit_to' => 'BIR'])->all(), 'credit_amount')))])->label(false) ?>
                </td>
            </tr>
            <tr>
                <td colspan="6" style="background-color: #f5f5f0; font-weight: bold;">
                    Details From Obligation Request and Status (ORS)
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <table class="table table-condensed table-bordered">
                            <tr>
                                <th style="text-align: center">Particulars</th>
                                <th style="text-align: center">ORS No</th>
                                <th style="text-align: center">MFO/PAP</th>
                                <th style="text-align: center">Responsibility Center</th>
                                <th style="text-align: center">Amount</th>
                            </tr>
                        <?php 
                              $i = 0;
                              $ors = explode(',', $model->ors);
                              for($x=0; $x<sizeof($ors); $x++) : 
                        ?>
                        <?php $ors_details = Ors::find()->where(['id' => $ors[$x]])->one(); ?>
                            <tr>
                                <td>
                                  <?= $form->field($model, 'particular[$i]')->textInput(['value' => $ors_details->particular, 'class' => 'textfield'])->label(false) ?>
                                    <?= $form->field($model, 'ors_id[$i]')->hiddenInput(['value' => $ors_details->id])->label(false) ?>
                                </td>
                                <td>
                                    <?= $form->field($model, 'ors_no[$i]')->textInput([
                                        'value' => $ors_details->ors_class.'-'.$ors_details->ors_year.'-'.$ors_details->ors_month.'-'.$ors_details->ors_serial, 'class' => 'textfield'])->label(false) 
                                    ?>
                                </td>
                                <td>
                                    <?= $form->field($model, 'mfo_pap[$i]')->textInput(['value' => $ors_details->mfo_pap, 'class' => 'textfield'])->label(false) ?>
                                </td>
                                <td style="width: 100px;">
                                    <?= $form->field($model, 'responsibility_center[$i]')->textInput(['value' => $ors_details->responsibility_center, 'class' => 'textfield'])->label(false) ?>
                                </td>
                                <td>
                                    <?= $form->field($model, 'amount[$i]')->textInput(['value' => $ors_details->amount, 'class' => 'textfield'])->label(false) ?>
                                </td>
                            </tr>
                          <?php $i++; ?>
                        <?php endfor ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="6" style="background-color: #f5f5f0; font-weight: bold;">Accounting Entry</td>
            </tr>
            <tr>
                <td colspan="6">
                    <table class="table table-bordered">
                        <tr>
                            <th style="text-align: center">ACCOUNT TITLE</th>
                            <th style="text-align: center">UACS CODE</th>
                            <th style="text-align: center">DEBIT</th>
                            <th style="text-align: center">CREDIT AMOUNT</th>
                            <th style="text-align: center">CREDIT TO</th>
                        </tr>
                        <?php foreach ($entries as $entry) : ?>
                        <tr>
                            <td><?= $entry->account_title ?></td>
                            <td><?= $entry->uacs_code ?></td>
                            <td width="75"><?= number_format($entry->debit, 2) ?></td>
                            <td width="100"><?= number_format($entry->credit_amount, 2) ?></td>
                            <td width="80"><?= $entry->credit_to ?></td>
                        </tr>
                    <?php endforeach ?>
                        <tr>
                            <td colspan="2" style="font-size: 18px;"><strong>TOTAL</strong></td>
                            <td>
                                <?php $totalDebit = AccountingEntry::find(['debit'])->where(['dv_no'=>$model->dv_no])->all();
                                       echo number_format(array_sum(ArrayHelper::getColumn($totalDebit, 'debit')), 2); ?>
                            </td>
                            <td>
                                <strong>
                                    <?php $total = AccountingEntry::find(['credit_amount'])->where(['dv_no'=>$model->dv_no])->all();
                                       echo number_format(array_sum(ArrayHelper::getColumn($total, 'credit_amount')), 2);
                                    ?>
                                </strong> 
                             </td>
                            <td width="80"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <?= $form->field($model, 'remarks')->textarea(['rows' => 3]) ?>
                </td>
            </tr>
        </table>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'disabled' => $disability == 1 ? true : false ]); ?>
            <?= Html::a('Close', ['/disbursement/disbursements', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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

