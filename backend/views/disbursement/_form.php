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
            <td><labe>DV NO.</labe></br></br><strong><?= isset($dv_no) ? $dv_no : $model->dv_no ?></strong></td>
            <td colspan="1" width="280"><?= $form->field($model, 'transaction_id')->dropDownList(ArrayHelper::map(transaction::find()->all(),'id', 'name'), ['prompt' => 'Select Transaction Type']) 
        ?>
            </td>
            <td width="160">
                <label>Cash Advance?</label></br>
                <?= $form->field($model, 'cash_advance')->dropDownList(['no'=>'No', 'yes'=>'Yes', 'liquidated'=>'Liquidated'])->label(false)?>

            </td>
            <td width="200"><?= $form->field($model, 'status')->dropDownList(['Unpaid'=>'Unpaid', 'Paid'=>'Paid', 'Cancelled'=>'Cancelled']) ?></td>
            <td width="100"><?= $form->field($model, 'date')->textInput(['value' => $model->date===null ? date('F d, Y') : $model->date]) ?></td>
        </tr>
        <tr>
            <td width="150"></td>
            <td colspan="1">
                <?= $form->field($model, 'mode_of_payment')->dropDownList(['mds_check'=>'MDS Check', 'commercial_check'=>'Commercial Check', 'lldap_ada'=>'LLDAP-ADA']) ?>
            </td>
            <td><?= $form->field($model, 'responsibility_center')->textInput(['maxlength' => true]) ?></td>
            <td width="200"> <?= $form->field($model, 'fund_cluster')->dropDownList(ArrayHelper::map(FundCluster::find()->all(),'fund_cluster','fund_cluster'),
                    [
                        'prompt'=>'Select Fund Cluster',
                        'onchange'=>'
                             $.post("index.php?r=nca/clusters&fund_cluster='.'"+$(this).val(),function(data){
                                $("select#disbursement-nca").html(data);
                            });'
                    ]); ?> 
            </td>
            <td><?= $form->field($model, 'nca')->dropDownList(ArrayHelper::map(Nca::find()->all(),'nca_no', 'nca_no')) ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <?= $form->field($model, 'payee')->textInput(['maxlength' => true]) ?>
            </td>
            <td width="120">
                <table>
                    <label>ORS No.</label>
                    <tr>
                        <td><?= $form->field($model, 'ors_class')->textInput(['maxlength' => 2, 'style'=>'width:50px'])->label(false) ?></td>
                        <td>-</td>
                        <td><?= $form->field($model, 'ors_year')->textInput(['maxlength' => 4, 'style'=>'width:60px'])->label(false) ?></td>
                        <td>-</td>
                        <td><?= $form->field($model, 'ors_month')->textInput(['maxlength' => 2, 'style'=>'width:50px'])->label(false) ?></td>
                        <td>-</td>
                        <td><?= $form->field($model, 'ors_serial')->textInput(['maxlength' => 4, 'style'=>'width:60px'])->label(false) ?></td>
                    </tr>
                </table>
            </td>
            <td><?= $form->field($model, 'tin')->textInput(['maxlength' => true]) ?></td>
        </tr>
        <tr>
            <td colspan="3"><?= $form->field($model, 'particulars')->textarea(['rows' => 4]) ?></td>
            <td> <?= $form->field($model, 'mfo_pap')->textInput(['maxlength' => true]) ?></td>
            <td>
                <?= $form->field($model, 'gross_amount')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'obligated')->hiddenInput(['value' => 'no'])->label(false) ?>
            </td>
        </tr>
    </table>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
