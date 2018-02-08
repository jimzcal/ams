<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Transaction;
use backend\models\Nca;

/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="disbursement-form">

    <?php $form = ActiveForm::begin(); ?>

    <table class="table table-bordered">
        <tr>
            <td><labe>DV NO.</labe></br></br><strong><?= isset($dv_no) ? $dv_no : $model->dv_no ?></strong></td>
            <td colspan="1"><?= $form->field($model, 'transaction_id')->dropDownList(ArrayHelper::map(transaction::find()->all(),'id', 'name'), ['prompt' => 'Select Transaction Type']) 
        ?>
            </td>
            <td width="160">
                <label>Cash Advance?</label></br>
                <?= $form->field($model, 'cash_advance')->dropDownList(['no'=>'No', 'yes'=>'Yes', 'liquidated'=>'Liquidated'])->label(false)?>

            </td>
            <td><?= $form->field($model, 'status')->dropDownList(['Unpaid'=>'Unpaid', 'Paid'=>'Paid', 'Cancel'=>'Cancelled']) ?></td>
            <td width="140"><?= $form->field($model, 'date')->textInput(['value' => $model->date===null ? date('M. d, Y') : $model->date]) ?></td>
        </tr>
        <tr>
            <td width="150"></td>
            <td colspan="2">
                <?= $form->field($model, 'mode_of_payment')->dropDownList(['mds_check'=>'MDS Check', 'commercial_check'=>'Commercial Check', 'lldap_ada'=>'LLDAP-ADA']) ?>
            </td>
            <td><?= $form->field($model, 'nca')->dropDownList(ArrayHelper::map(Nca::find()->all(),'nca_no', 'nca_no')) ?>
            </td>
            <td><?= $form->field($model, 'fund_source')->textInput(['maxlength' => true]) ?></td>
        </tr>
        <tr>
            <td colspan="3">
                <?= $form->field($model, 'payee')->textInput(['maxlength' => true]) ?>
            </td>
            <td width="120"><?= $form->field($model, 'responsibility_center')->textInput(['maxlength' => true]) ?></td>
            <td><?= $form->field($model, 'ors_no')->textInput(['maxlength' => true]) ?></td>
        </tr>
        <tr>
            <td colspan="3"><?= $form->field($model, 'particulars')->textarea(['rows' => 4]) ?></td>
            <td> <?= $form->field($model, 'mfo_pap')->textInput(['maxlength' => true]) ?></td>
            <td><?= $form->field($model, 'gross_amount')->textInput(['maxlength' => true]) ?></td>
        </tr>
    </table>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
