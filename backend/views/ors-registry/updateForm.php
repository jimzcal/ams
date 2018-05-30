<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Ors;
use backend\models\OrsRegistry;

/* @var $this yii\web\View */
/* @var $model backend\models\OrsRegistry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ors-registry-form">

    <?php $form = ActiveForm::begin(); ?>

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
        <?php foreach ($model_registry as $value) : ?>
            <?php $ors_registry = OrsRegistry::find()->where(['id' => $value])->all(); ?>
                <?php foreach ($ors_registry as $value) : ?>
                    <tr>
                        <td>
                            <?= $form->field($model, 'ors_no[]')->textInput(['maxlength' => true, 'value' => $value->ors_class.'-'.$value->funding_source.'-'.$value->ors_year.'-'.$value->ors_month.'-'.$value->ors_serial, 'class' => 'textfield'])->label(false) ?>
                        </td>
                        <td style="width: 170px;">
                            <?= $value->particular ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'mfo_pap[]')->textInput(['maxlength' => true, 'value' => $value->mfo_pap])->label(false) ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'responsibility_center[]')->textInput(['maxlength' => true, 'value' => $value->responsibility_center])->label(false) ?>
                        </td>
                        <td style="width: 100px;">
                            <?= $form->field($model, 'obligation[]')->textInput(['maxlength' => true, 'value' => $value->amount/sizeof($model_registry)])->label(false) ?>
                        </td>
                        <td style="width: 100px;">
                            <?= $form->field($model, 'payable[]')->textInput(['maxlength' => true, 'value' => $less = $dv->gross_amount])->label(false) ?>
                        </td>
                        <td style="width: 100px;">
                            <?= $form->field($model, 'payment[]')->textInput(['maxlength' => true, 'value' => ($dv->less_amount)])->label(false) ?>
                        </td>
                    </tr>
                <?php endforeach ?>
        <?php endforeach ?>
        </table>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
