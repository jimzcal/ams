<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use backend\models\Ors;
use backend\models\OrsRegistry;

/* @var $this yii\web\View */
/* @var $model backend\models\OrsRegistry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ors-registry-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php foreach ($ors_ids as $key => $value) : ?>

    <div class="view-index">
        <div class="mini-header">
            <i class="fa fa-line-chart"></i> Obligation Status <?= '(' .($key+1).')' ?>
        </div>

    <table class="table table-condensed table-striped table-bordered">
        <tr>
            <th>ORS No.</th>
            <th>Particulars</th>
            <th>MFO/PAP</th>
            <th>Res. Center</th>
            <th>Obligation</th>
            <th>Payable</th>
            <th>Payment</th>
        </tr>
            <?php $ors = Ors::find()->where(['id' => $value])->one(); ?>
                <?php $ors_reg = OrsRegistry::find()->where(['ors_id' => $ors->id])->all(); ?>
                <?php foreach ($ors_reg as $val) : ?>
                    <tr>
                        <td>
                            <?= $val->ors_class.'-'.$val->funding_source.'-'.$val->ors_year.'-'.$val->ors_month.'-'.$val->ors_serial ?>
                        </td>
                        <td><?= $ors->particular ?></td>
                        <td><?=  $val->mfo_pap ?></td>
                        <td><?=  $val->responsibility_center ?></td>
                        <td><?=  $val->obligation ?></td>
                        <td><?=  $val->payable ?></td>
                        <td><?=  $val->payment ?></td>
                    </tr>
                <?php endforeach ?>
        <tr>
            <td style="width: 190px;">
                <?= $form->field($model, 'ors_no[]')->textInput(['maxlength' => true, 'value' => $ors->ors_class.'-'.$ors->funding_source.'-'.$ors->ors_year.'-'.$ors->ors_month.'-'.$ors->ors_serial, 'class' => 'textfield'])->label(false) ?>
                <?= $form->field($model, 'ors_id[]')->hiddenInput(['maxlength' => true, 'value' => $value])->label(false) ?>
            </td>
            <td style="width: 300px;">
                <?= $form->field($model, 'particular[]')->textArea(['maxlength' => true, 'rows' => 3, 'value' => $dv->particulars, 'class' => 'textfield'])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'mfo_pap[]')->textInput(['maxlength' => true, 'value' => $ors->mfo_pap, 'class' => 'textfield'])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'responsibility_center[]')->textInput(['maxlength' => true, 'value' => $ors->responsibility_center, 'class' => 'textfield'])->label(false) ?>
            </td>
            <td style="width: 100px;">
                <?= $form->field($model, 'obligation[]')->textInput(['maxlength' => true, 'value' => $ors->amount, 'class' => 'textfield'])->label(false) ?>
            </td>
            <td style="width: 100px;">
                <?= $form->field($model, 'payable[]')->textInput(['maxlength' => true, 'class' => 'textfield'])->label(false) ?>
            </td>
            <td style="width: 100px;">
                <?= $form->field($model, 'payment[]')->textInput(['maxlength' => true, 'class' => 'textfield'])->label(false) ?>
            </td>
        </tr>
    </table>
    </div>
    <?php endforeach ?>

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

<?php
$this->registerJs("
     $('tbody th').css('text-align', 'center');
 ");
?>

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
