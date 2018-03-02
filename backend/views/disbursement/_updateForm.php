<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Transaction;
use backend\models\Nca;
use backend\models\FundCluster;

/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="disbursement-form">

    <?php $form = ActiveForm::begin(); ?> 

    <table class="table table-bordered">
       <tr>
           <td colspan="4" style="font-style: italic;">Note: All fields of this form are required. Please, provide appropriate details.</td>
           <td style="font-size: 18px; width: 220px;">
                DV No. <strong> <?= isset($dv_no) ? $dv_no : $model->dv_no ?></strong>
           </td>
       </tr>
       <tr>
           <td style="width: 380px;">
               <?= $form->field($model, 'payee')->textInput(['maxlength' => true]) ?>
           </td>
           <td>
               <?= $form->field($model, 'tin')->textInput(['maxlength' => true]) ?>
           </td>
           <td style="width: 200px;">
               <?= $form->field($model, 'transaction_id')->dropDownList(ArrayHelper::map(transaction::find()->all(),'id', 'name'), ['prompt' => 'Select Transaction Type']) ?>
           </td>
           <td style="width: 200px;">
            <?= $form->field($model, 'cash_advance')->dropDownList(['no'=>'No', 'yes'=>'Yes', 'liquidated'=>'Liquidated']) ?>
           </td>
           <td>
            <?= $form->field($model, 'date')->textInput(['value' => $model->date===null ? date('F d, Y') : $model->date]) ?>
           </td>
       </tr>
       <tr>
           <td>
               <?= $form->field($model, 'mode_of_payment')->dropDownList(['mds_check'=>'MDS Check', 'commercial_check'=>'Commercial Check', 'lldap_ada'=>'LLDAP-ADA']) ?>
           </td>
           <td>
               <?= $form->field($model, 'fund_cluster')->dropDownList(ArrayHelper::map(FundCluster::find()->all(),'fund_cluster','fund_cluster'),
                    [
                        // 'prompt'=>'Select Fund Cluster',
                        'onchange'=>'
                             $.post("index.php?r=nca/clusters&fund_cluster='.'"+$(this).val(),function(data){
                                $("select#disbursement-nca").html(data);
                            });'
                    ]); ?>
           </td>
           <td>
                <?= $form->field($model, 'nca')->dropDownList(ArrayHelper::map(Nca::find()->all(),'nca_no', 'nca_no')) ?>
           </td>
           <td>
               <?= $form->field($model, 'status')->dropDownList(['Unpaid'=>'Unpaid', 'Paid'=>'Paid', 'Cancelled'=>'Cancelled']) ?>
           </td>
           <td>
               <?= $form->field($model, 'gross_amount')->textInput(['maxlength' => true]) ?>
               <?= $form->field($model, 'obligated')->hiddenInput(['value' => 'no'])->label(false) ?>
           </td>
       </tr>
       <tr>
           <td colspan="5">
                <table class="table table-condensed" id="dynamicInput">
                    <tr>
                        <th>Particulars</th>
                        <th>ORS No.</th>
                        <th>MFO/PAP</th>
                        <th>Responsibility Center</th>
                        <th>Amount</th>
                        <th><button class="btn btn-success" type="button" onClick="addInput('dynamicInput')" ><i class="glyphicon glyphicon-plus"></i></button></th>
                    </tr>
                    <?php foreach ($ors_model as $value) : ?>
                      <?php $i=0; ?>
                        <tr>
                            <td style="width: 350px;">
                              <input type="hidden" name="ids[<?= $i ?>]" class="form-control" required="true" value= "<?= $value->id; ?>" >

                                <input type="text" name="particular[<?= $i ?>]" class="form-control" required="true" value= "<?= $value->particular; ?>" >
                            </td>
                            <td>
                                <input type="text" name="ors_no[<?= $i ?>]" class="form-control" required="true" value= "<?= $value->ors_class.'-'.$value->ors_year.'-'.$value->ors_month.'-'.$value->ors_serial ?>" >
                            </td>
                            <td>
                                <input type="text" name="mfo_pap[<?= $i ?>]" class="form-control" required="true" value= "<?= $value->mfo_pap ?>" >
                            </td>
                            <td>
                                <input type="text" name="responsibility_center[<?= $i ?>]" class="form-control" required="true" value= "<?= $value->responsibility_center ?>" >
                            </td>
                            <td style="width: 100px;">
                                <input type="number" name="amount[<?= $i ?>]" class="form-control" required="true" value= "<?= $value->amount ?>" >
                            </td>
                            <td></td>
                        </tr>
                      <?php $i++; ?>
                    <?php endforeach ?>
                </table>
           </td>
       </tr>
    </table>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<script>

var counter = <?= sizeof($ors_model) ?>;
var limit = 6;
function addInput(dynamicInput)
{
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
          var newdiv = document.createElement('tr');
          newdiv.innerHTML = "<tr class='form-group'><td style='width: 350px;'><input type='text' name='particular["+counter+"]' class='form-control' style='width: 98%; margin-left: auto; margin-right: auto; margin-bottom: 15px;'></td><td><input type='text' name='ors_no["+counter+"]' class='form-control' style='width: 98%; margin-left: auto; margin-right: auto; margin-bottom: 15px;'></td><td><input type='text' name='mfo_pap["+counter+"]' class='form-control' style='width: 98%; margin-left: auto; margin-right: auto; margin-bottom: 15px;'></td><td><input type='text' name='responsibility_center["+counter+"]' class='form-control' style='width: 98%; margin-left: auto; margin-right: auto; margin-bottom: 15px;'></td><td style='width: 100px;'><input type='number' name='amount["+counter+"]' class='form-control' style='width: 93%; margin-left: auto; margin-right: auto; margin-bottom: 15px;'></td><td></td></tr>";

          document.getElementById("dynamicInput").appendChild(newdiv);
          counter++;
     }
}

</script>



