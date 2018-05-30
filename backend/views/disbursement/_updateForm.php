<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Transaction;
use backend\models\Nca;
use backend\models\FundCluster;
use backend\models\Ors;

/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="disbursement-form">

    <?php $form = ActiveForm::begin(); ?> 

    <table class="table">
       <tr>
           <td colspan="5" style="font-style: italic;">Note: All fields of this form are required. Please, provide appropriate details.</td>
           <td style="font-size: 18px; width: 220px;">
                DV No. <strong> <?= isset($dv_no) ? $dv_no : $model->dv_no ?></strong>
           </td>
       </tr>
       <tr>
           <td style="width: 380px;" colspan="2">
               <?= $form->field($model, 'payee')->textInput(['maxlength' => true]) ?>
           </td>
           <td>
               <?= $form->field($model, 'tin')->textInput(['maxlength' => true]) ?>
           </td>
           <td style="width: 200px;">
               <?= $form->field($model, 'transaction_id')->dropDownList(ArrayHelper::map(transaction::find()->all(),'id', 'name'), ['prompt' => 'Select Transaction Type']) ?>
           </td>
           <td style="width: 200px;">
            <?= $form->field($model, 'cash_advance')->dropDownList(['no'=>'No', 'yes'=>'Yes'], ['id' => 'advance']) ?>
           </td>
           <td>
            <?= $form->field($model, 'date')->textInput(['value' => $model->date===null ? date('F d, Y') : $model->date]) ?>
           </td>
       </tr>
       <tr>
           <td rowspan="2" colspan="3">
               <?= $form->field($model, 'particulars')->textarea(['rows' => 6]) ?>
           </td>
           <td>
            <?= $form->field($model, 'fund_cluster')->dropDownList(ArrayHelper::map(FundCluster::find()->all(),'fund_cluster','fund_cluster'),
                    [
                        // 'prompt'=>'Select Fund Cluster',
                        'onchange'=>'
                             $.post("index.php?r=nca/clusters&fund_cluster='.'"+$(this).val(),function(data){
                                $("select#disbursement-nca").html(data);
                            });'
                    ]); 
                ?>
           </td>
           <td>
               <?= $form->field($model, 'nca')->dropDownList(ArrayHelper::map(Nca::find()->all(),'nca_no', 'nca_no'),
                    [
                      'prompt'=>'Select NCA No.',
                      'onchange'=>'
                             $.post("index.php?r=nca/sources&nca_no='.'"+$(this).val(),function(data){
                                $("select#disbursement-funding_source").html(data);
                            });'
                    ]);
               ?>
           </td>
           <td>
              <?= $form->field($model, 'funding_source')->dropDownList(ArrayHelper::map(Nca::find()->all(),'funding_source', 'funding_source'),
                  [
                    'prompt'=>'Select Funding Source',
                  ]);
               ?>
           </td>
       </tr>
       <tr>
         <td>
           <?= $form->field($model, 'mode_of_payment')->dropDownList(['mds_check'=>'MDS Check', 'commercial_check'=>'Commercial Check', 'lldap_ada'=>'LLDAP-ADA']) ?>
         </td>
         <td>
           <?= $form->field($model, 'status')->dropDownList(['Received'=>'Received', 'Earmarked'=>'Earmarked', 'Approved'=>'Approved', 'Paid'=>'Paid', 'Cancelled'=>'Cancelled']) ?>
         </td>
         <td>
           <?= $form->field($model, 'gross_amount')->textInput(['maxlength' => true, 'id' => 'totalAmount']) ?>
           <?= $form->field($model, 'obligated')->hiddenInput(['value' => 'no'])->label(false) ?>
         </td>
       </tr>
       <tr>
           <td colspan="6">
                <table class="table table-condensed table-striped" id="dynamicInput">
                    <tr>
                        <th>ORS No.</th>
                        <th>MFO/PAP</th>
                        <th>Responsibility Center</th>
                        <th>Amount</th>
                        <th><button class="btn btn-success" type="button" onClick="addInput('dynamicInput')" ><i class="glyphicon glyphicon-plus"></i></button></th>
                    </tr>
                    <?php 
                          $i = 0;
                          $ors = explode(',', $model->ors);
                          for($x=0; $x<sizeof($ors); $x++) : 
                    ?>
                    <?php $ors_details = Ors::find()->where(['id' => $ors[$i]])->one(); ?>
                        <tr>
                            <td>
                              <input type="hidden" name="ors_id[<?= $i ?>]" class="form-control" required="true" value= "<?= $ors_details->id; ?>" >
                                <input type="text" name="ors_no[<?= $i ?>]" class="form-control" required="true" value= "<?= $ors_details->ors_class.'-'.$ors_details->funding_source.'-'.$ors_details->ors_year.'-'.$ors_details->ors_month.'-'.$ors_details->ors_serial ?>" >
                            </td>
                            <td>
                                <input type="text" name="mfo_pap[<?= $i ?>]" class="form-control" required="true" value= "<?= $ors_details->mfo_pap ?>" >
                            </td>
                            <td>
                                <input type="text" name="responsibility_center[<?= $i ?>]" class="form-control" required="true" value= "<?= $ors_details->responsibility_center ?>" >
                            </td>
                            <td style="width: 100px;">
                                <input type="number" name="amount[<?= $i ?>]" class="form-control num" required="true" value= "<?= $ors_details->amount ?>" >
                            </td>
                            <td></td>
                        </tr>
                      <?php $i++; ?>
                    <?php endfor ?>
                </table>
                <?= $form->field($model, 'period')->hiddenInput(['id' => 'fperiod'])->label(false) ?>
           </td>
       </tr>
    </table>
    <div class="form-group" style="padding-left: 15px;">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
             <h4 class="modal-title">Due Period</h4>
          </div>
          <div class="modal-body">
            <table width="500">       
                <tr>
                  <td>
                    <?= $form->field($model, 'due')->dropDownList(['30'=>'30 days', '60'=>'60 days', '20' => '20 days'], ['id' => 'period', 'prompt' => 'Select No. of days'])->label("No of days to Liquidate this Cash Advance: ") ?>
                  </td>
                </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>
          </div>
        </div>
      </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<script>

var counter = <?= sizeof($ors) ?>;
var limit = 6;
function addInput(dynamicInput)
{
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
          var newdiv = document.createElement('tr');
          newdiv.innerHTML = "<tr class='form-group'><td><input type='text' name='ors_no["+counter+"]' class='form-control' style='width: 98%; margin-left: auto; margin-right: auto; margin-bottom: 15px;'></td><td><input type='text' name='mfo_pap["+counter+"]' class='form-control' style='width: 98%; margin-left: auto; margin-right: auto; margin-bottom: 15px;'></td><td><input type='text' name='responsibility_center["+counter+"]' class='form-control' style='width: 98%; margin-left: auto; margin-right: auto; margin-bottom: 15px;'></td><td style='width: 100px;'><input type='number' name='amount["+counter+"]' class='form-control num' style='width: 93%; margin-left: auto; margin-right: auto; margin-bottom: 15px;'></td><td></td></tr>";

          document.getElementById("dynamicInput").appendChild(newdiv);
          counter++;
     }
}

window.onload = function()
{

$(".num").each(function() {

            $(this).change(function(){
                calculateSum();
            });
        });

    function calculateSum() {

        var sum = 0;
        //iterate through each textboxes and add the values
        $(".num").each(function() {

            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }

        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("#totalAmount").val(sum.toFixed(2));
    }

  $(document).on("change", "select[id='advance']", function () { 
        // alert($(this).val())
        $modal = $('#myModal');
        if($(this).val() == 'yes'){
            $modal.modal('show');
        }
    });

  $(document).on("change", "select[id='period']", function () { 
        // alert($(this).val())
        var value = 0;
        $modal = $('#myModal');
        if($(this).val() != null && $(this).val() > 0) 
        {
            value = this.value;
            $("#fperiod").val(value);
        }
    });

}
</script>



