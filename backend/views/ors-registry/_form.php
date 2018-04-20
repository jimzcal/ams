<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\OrsRegistry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ors-registry-form">

    <?php $form = ActiveForm::begin(); ?>

    <table class="table table-condensed table-striped table-bordered">
        <tr>
            <th>ORS No.</th>
            <th>MFO/PAP</th>
            <th>Responsibility Center</th>
            <th>Gross Amount</th>
            <th>Less Amount</th>
            <th>Net Amount</th>
        </tr>
        <?php foreach ($model_registry as $value) : ?>
        <tr>
            <td>
                <?= $form->field($model, 'ors_no[]')->textInput(['maxlength' => true, 'value' => $value->ors_class.'-'.$value->funding_source.'-'.$value->ors_year.'-'.$value->ors_month.'-'.$value->ors_serial])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'mfo_pap[]')->textInput(['maxlength' => true, 'value' => $value->mfo_pap])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'responsibility_center[]')->textInput(['maxlength' => true, 'value' => $value->responsibility_center])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'gross_amount[]')->textInput(['maxlength' => true, 'value' => $value->amount])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'less_amount[]')->textInput(['maxlength' => true, 'value' => $less = $dv->less_amount != 0 ? $value->amount-($dv->less_amount/sizeof($model_registry)) : 0.00 ])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'net_amount[]')->textInput(['maxlength' => true, 'value' => ($value->amount - $less)])->label(false) ?>
            </td>
        </tr>
        <?php endforeach ?>
    </table>

    <div class="form-group">
        <div class="btn btn-success" data-toggle="modal" data-target="#myModal">Save</div>
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
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
          </div>
        </div>
      </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<!-- <script>
    window.addEventListener("DOMContentLoaded", function() {
        $(document).on("click", "select[id='save']", function () { 
            // alert($(this).val())
            $modal = $('#myModal');
            if($(this).val() == 'Paid'){
                $modal.modal('show');
            }
        });
    }, false);
</script> -->
