<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Transaction;
use backend\models\Nca;
use backend\models\FundCluster;
use backend\models\MfoPap;
use backend\models\ResponsibilityCenter;
use timurmelnikov\widgets\WebcamShoot ; 
use kartik\select2\Select2;
Use backend\models\Ors;
use kartik\date\DatePicker;
use backend\models\Employees;

/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */
/* @var $form yii\widgets\ActiveForm */
?>

<style type="text/css">
  
#field2{
  display: none;
  }

#field3{
  display: none;
  }
</style>

<div class="disbursement-form">
  <div class="view-index" id="form-wrapper">
      <?php $form = ActiveForm::begin(); ?> 

      <table class="mytable">
         <tr style="border-bottom-style: dashed; border-color: #f5f5f0;">
             <td colspan="5" style="font-style: italic;">Note: All fields of this form are required. Please, provide appropriate details.</td>
             <td style="font-size: 18px; width: 220px;">
                  DV No. <strong> <?= isset($dv_no) ? $dv_no : $model->dv_no ?></strong>
             </td>
         </tr>
         <tr>
             <td style="width: 380px;" colspan="2">
                 <?= $form->field($model, 'payee')->textInput(['maxlength' => true, 'style' => 'text-transform: uppercase']) ?>
             </td>
             <td colspan="2">
                 <?= $form->field($model, 'tin')->textInput(['maxlength' => true]) ?>
             </td>
             <td style="width: 200px;">
              <?= $form->field($model, 'fund_cluster')->dropDownList(ArrayHelper::map(FundCluster::find()->all(),'fund_cluster','fund_cluster'),
                      [
                          'prompt'=>'Select Fund Cluster',
                      ]); 
                  ?>
             </td>
             <td style="width: 200px;">
              <?= $form->field($model, 'date')->textInput(['value' => $model->date===null ? date('Y-F-d') : $model->date]) ?>
              <?php /* $form->field($model, 'date')->widget(DatePicker::classname(), [
                  'options' => ['value' => date('M. d, Y'), 'style' => 'width: 196px; right: 0px;'],
                  'pluginOptions' => [
                    'todayHighlight' => true,
                    'format' => 'M. d, yyyy'
                      ]
                  ])->label(false); */
                ?>
             </td>
         </tr>
         <tr>
             <td rowspan="2" colspan="4">
                 <?= $form->field($model, 'particulars')->textarea(['rows' => 6]) ?>
             </td>
             <td>
              <?= $form->field($model, 'mode_of_payment')->dropDownList(['mds_check'=>'MDS Check', 'commercial_check'=>'Commercial Check', 'lldap_ada'=>'LLDAP-ADA']) ?>
             </td>
             <td style="width: 200px;">
               <?= $form->field($model, 'transaction_id')->dropDownList(ArrayHelper::map(transaction::find()->all(),'id', 'name')) ?>
             </td>
         </tr>
         <tr>
           <td>
             <?= $form->field($model, 'cash_advance')->dropDownList(['no'=>'No', 'yes'=>'Yes'], ['id' => 'advance']) ?>
           </td>
           <td>
             <?= $form->field($model, 'gross_amount')->textInput(['maxlength' => true, 'id' => 'totalAmount']) ?>
             <?= $form->field($model, 'obligated')->hiddenInput(['value' => 'no'])->label(false) ?>
           </td>
         </tr>
         <tr style="border-bottom-style: dashed; border-color: #f5f5f0;">
           <td colspan="2" style="font-style: italic;">
               Obligation Request and Status (ORS)
           </td>
           <td style="width: 100px;"></td>
           <td style="font-style: italic;">
               Client Details
           </td>
           <td colspan="2" style="text-align: right">
             <input type="radio" name="client" id="selected" value="id" checked="checked"> <label>ID No.</label>
             <input type="radio" name="client" id="selected" value="qr"> <label>QR Code</label>
             <input type="radio" name="client" id="selected" value="bio"> <label>Biometrics</label>
           </td>
         </tr>
         <tr>
           <td colspan="2">
            <?= $form->field($model, 'ors')->widget(Select2::classname(), [

                'data' => ArrayHelper::map(Ors::find()->all(),'id', function($model){
                  return $model->ors_class.'-'.$model->funding_source.'-'.$model->ors_year.'-'.$model->ors_month.'-'.$model->ors_serial;
                }),
                'options' => ['value' => explode(',', $model->ors), 'multiple' => true],
              ])->label(false); 
            ?>
               <?= $form->field($model, 'period')->hiddenInput(['id' => 'fperiod'])->label(false) ?>
           </td>
           <td></td>
           <td colspan="3" style="padding: 5px;">
               <?= $form->field($model, 'employee_id')->widget(Select2::classname(), [
                  'data' => ArrayHelper::map(Employees::find()->all(),'employee_id', function($model){
                    return $model->employee_id.' - '.$model->name;
                  }),
                  //'language' => 'eng',
                  'options' => ['value' => $model->employee_id, 'multiple' => false],
              ])->label(false); ?>

               <?php // $form->field($model, 'employee_id')->textInput(['id' => 'field2', 'placeholder' => 'Employee QR Code', 'autofocus' => true])->label(false) ?>

               <?php // $form->field($model, 'employee_id')->textInput(['id' => 'field3', 'placeholder' => 'Employee Biometric', 'autofocus' => true])->label(false) ?>
           </td>
         </tr>
      </table>

      <div class="form-group">
          <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      </div>
  </div>

  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title">Due Date</h4>
        </div>
        <div class="modal-body">
          <table width="500">       
             <td>
                  <?= $form->field($model, 'due')->widget(DatePicker::classname(), [
                  'options' => ['style' => 'width: 400px; right: 0px;'],
                    'pluginOptions' => [
                      'todayHighlight' => true,
                      'format' => 'yyyy-mm-dd',
                        ]
                  ])->label("Select Date"); 
                ?>
                </td>
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
window.onload = function()
{

  $("input[id='selected']").click(function () { 

        if($(this).val() == 'id') 
        {
            $('#field1').show();
            $('#field2').hide();
            $('#field3').hide();
        }

        if($(this).val() == 'qr') 
        {
            $('#field1').hide();
            $('#field2').show();
            $('#field3').hide();
        }

        if($(this).val() == 'bio') 
        {
            $('#field1').hide();
            $('#field2').hide();
            $('#field3').show();
        }
    });

  $(document).on("change", "select[id='advance']", function () { 
        // alert($(this).val())
        $modal = $('#myModal');
        if($(this).val() == 'yes'){
            $modal.modal('show');
        }
    });

  $("input[id='disbursement-due']").change(function () { 
        // alert($(this).val())
        var value = 0;
        //$modal = $('#myModal');
        if($(this).val() != null)
        {
            value = this.value;
            $("#fperiod").val(value);
        }
    });

}
</script>