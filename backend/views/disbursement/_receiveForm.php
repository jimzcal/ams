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

<div class="disbursement-form">
  <?php $form = ActiveForm::begin(); ?> 
    <table class="table table-condensed table-striped" style="width: 550px; margin-left: auto; margin-right: auto; style="font-size: 12px;">
      <tr>
        <td style="width: 100px; font-size: 12px; color: #8c8c8c; font-style: italic; text-align: right; vertical-align: middle;">
          Date :
        </td>
        <td style="height: 40px;">
          <?= $form->field($dvlog_model, 'date', ['options' => ['tag' => false]])->textInput(['class' => 'textfield', 'maxlength' => true, 'autofocus' => true, 'readonly'=> true, 'value' => date('Y-m-d g:i a')])->label(false) ?>
        </td>
      </tr>
      <tr>
        <td style="width: 100px; font-size: 12px; color: #8c8c8c; font-style: italic; text-align: right; vertical-align: middle;">
          DV No :
        </td>
        <td style="height: 40px;">
          <?= $form->field($dvlog_model, 'dv_no', ['options' => ['tag' => false]])->textInput(['class' => 'textfield', 'maxlength' => true, 'readOnly' => true, 'value' => $model->dv_no])->label(false) ?>
        </td>
      </tr>
      <tr>
        <td style="width: 100px; font-size: 12px; color: #8c8c8c; font-style: italic; text-align: right; vertical-align: middle;">
          Received By :
        </td>
        <td style="height: 40px;">
          <?= $form->field($dvlog_model, 'employee_id', ['options' => ['tag' => false]])->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Employees::find()->all(),'employee_id', function($model){
                  return $model->employee_id.' - '.$model->name;
                }),
                //'language' => 'eng',
                'options' => ['placeholder' => 'Enter Employee ID', 'multiple' => false, 'class' => 'textfield'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false); ?>
        </td>
      </tr>
    </table>
  
    <div class="form-group" style="padding-left: 10px;">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
  <?php ActiveForm::end(); ?>
</div>





