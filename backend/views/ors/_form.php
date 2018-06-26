<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use backend\models\Far101;
use backend\models\Nca;
use backend\models\ResponsibilityCenter;

/* @var $this yii\web\View */
/* @var $model backend\models\Ors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ors-form">

    <?php $form = ActiveForm::begin(); ?>

    <table class="mytable"> 
        <tr style="border-bottom-style: dashed; border-bottom-color: #f5f5f0 ">
            <td colspan="6">ORS No.</td>
            <td style="width: 180px; float: right">
                <?php //$form->field($model, 'date')->textInput(['maxlength' => true])->label(false) ?>
            </td>
        </tr>
        <tr>
            <td colspan="7" style="height: 10px;"></td>
        </tr>
        <tr>
            <td class="td"><?= $form->field($model, 'ors_class')->textInput(['maxlength' => true, 'placeholder' => 'Allot. Class'])->label(false) ?></td>
            <td class="td">
                <?= $form->field($model, 'funding_source')->dropDownList(ArrayHelper::map(nca::find()->all(),'funding_source', 'funding_source'))->label(false) ?>
            </td>
            <td class="td"><?= $form->field($model, 'ors_year')->textInput(['maxlength' => true, 'placeholder' => 'Fiscal Year'])->label(false) ?></td>
            <td class="td"><?= $form->field($model, 'ors_month')->textInput(['maxlength' => true, 'placeholder' => 'Month'])->label(false) ?></td>
            <td class="td"><?= $form->field($model, 'ors_serial')->textInput(['maxlength' => true, 'placeholder' => 'Series'])->label(false) ?></td>
            <td></td>
            <td style="width: 180px; float: right"></td>
        </tr>
        <tr>
            <td colspan="4" rowspan="2"><?= $form->field($model, 'particular')->textArea(['rows' => 6]) ?></td>
            <td colspan="3">
                <?= $form->field($model, 'mfo_pap')->textInput() ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <?= $form->field($model, 'responsibility_center')->dropDownList(ArrayHelper::map(ResponsibilityCenter::find()->all(),'code', 'description')) ?>
            </td>
        </tr>
        <tr>
            <td colspan="2"><?= $form->field($model, 'obligation')->textInput(['maxlength' => true, 'value' => $model->obligation == null ? 0.00 : $model->obligation, 'style' => 'text-align: right; font-weight: bold;']) ?></td>
            <td colspan="2">
                
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
