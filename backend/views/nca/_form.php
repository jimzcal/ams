<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\FundCluster;

/* @var $this yii\web\View */
/* @var $model backend\models\Nca */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nca-form">

    <?php $form = ActiveForm::begin(); ?>
        <table class="table table-bordered">
            <tr>
                <td>
                    <?= $form->field($model, 'fund_cluster')->dropDownList(ArrayHelper::map(FundCluster::find()->all(),'fund_cluster','fund_cluster'),
                    [
                        'prompt'=>'Select Fund Cluster',

                    ]); ?>
                </td>
                <td><?= $form->field($model, 'date_received')->textInput(['maxlength' => true, 'value' => date('M. d, Y')]) ?></td>
                <td colspan="2" rowspan="2"><?= $form->field($model, 'purpose')->textarea(['rows' => 5]) ?></td>
            </tr>
            <tr>
                <td><?= $form->field($model, 'nca_no')->textInput(['maxlength' => true]) ?></td>
                <td><?= $form->field($model, 'fiscal_year')->dropDownList(['2017' => '2017', '2018' => '2018', '2019' => '2019', '2020' => '2020', '2021' => '2021']) ?></td>
            <tr>
                <td><?= $form->field($model, 'mds_sub_acc_no')->textInput(['maxlength' => true]) ?></td>
                <td><?= $form->field($model, 'total_amount')->textInput(['maxlength' => true]) ?></td>
                <td colspan="2"><?= $form->field($model, 'gsb_branch')->textarea(['rows' => 2]) ?></td>
            </tr>
            <tr>
                <td><?= $form->field($model, 'january')->textInput(['placeholder' => 'Amount alloted for January', 'value' => $model->january=== null ? 0 : $model->january ]) ?></td>
                <td><?= $form->field($model, 'february')->textInput(['placeholder' => 'Amount alloted for February', 'value' => $model->february=== null ? 0 : $model->february]) ?></td>
                <td><?= $form->field($model, 'march')->textInput(['placeholder' => 'Amount alloted for March', 'value' => $model->march=== null ? 0 : $model->march ]) ?></td>
                <td><?= $form->field($model, 'april')->textInput(['placeholder' => 'Amount alloted for April', 'value' => $model->april=== null ? 0 : $model->april ]) ?></td>
            </tr>
            <tr>
                <td><?= $form->field($model, 'may')->textInput(['placeholder' => 'Amount alloted for May', 'value' => $model->may=== null ? 0 : $model->may ]) ?></td>
                <td><?= $form->field($model, 'june')->textInput(['placeholder' => 'Amount alloted for June', 'value' => $model->june=== null ? 0 : $model->june ]) ?></td>
                <td><?= $form->field($model, 'july')->textInput(['placeholder' => 'Amount alloted for July', 'value' => $model->july=== null ? 0 : $model->july ]) ?></td>
                <td><?= $form->field($model, 'august')->textInput(['placeholder' => 'Amount alloted for August', 'value' => $model->august=== null ? 0 : $model->august ]) ?></td>
            </tr>
            <tr>
                <td><?= $form->field($model, 'september')->textInput(['placeholder' => 'Amount alloted for September', 'value' => $model->september=== null ? 0 : $model->september ]) ?></td>
                <td><?= $form->field($model, 'october')->textInput(['placeholder' => 'Amount alloted for October', 'value' => $model->october=== null ? 0 : $model->october ]) ?></td>
                <td><?= $form->field($model, 'november')->textInput(['placeholder' => 'Amount alloted for November', 'value' => $model->november=== null ? 0 : $model->november ]) ?></td>
                <td><?= $form->field($model, 'december')->textInput(['placeholder' => 'Amount alloted for December', 'value' => $model->december=== null ? 0 : $model->december ]) ?></td>
            </tr>
        </table>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
