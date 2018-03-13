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
                <td>
                    <?= $form->field($model, 'date_received')->textInput(['maxlength' => true, 'value' => date('M. d, Y')]) ?>
                </td>
                <td colspan="2" rowspan="3">
                    <?= $form->field($model, 'purpose')->textarea(['rows' => 10]) ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?= $form->field($model, 'nca_no')->textInput(['maxlength' => true]) ?>
                </td>
                <td>
                    <?= $form->field($model, 'fiscal_year')->dropDownList(['2017' => '2017', '2018' => '2018', '2019' => '2019', '2020' => '2020', '2021' => '2021', '2022' => '2022']) ?>
                </td>
            <tr>
                <td><?= $form->field($model, 'nca_type')->textInput(['maxlength' => true]) ?></td>
                <td><?= $form->field($model, 'total_amount')->textInput(['maxlength' => true]) ?></td>
            </tr>
            <tr>
                <td colspan="4" style="background-color: #f5f5f0">
                   <strong>MONTHLY REQUIREMENTS SCHEDULE</strong>
                   <button class="btn btn-success btn-right" type="button" onClick="addInput('dynamicInput')" ><i class="glyphicon glyphicon-plus"></i></button>
                </td>
            </tr>
            <tr>
                <td colspan="4" id="dynamicInput">
                    <table class="table table-bordered" style="width: 97%; margin-right: auto; margin-left: auto; padding: 10px;">
                        <tr>
                            <td colspan="2">
                                <label>Funding Source Code</label>
                                <input type="text" name="funding_source[0]" class="form-control" required>
                            </td>
                            <td>
                                <label>MDS Sub-account No.</label>
                                <input type="text" name="mds_sub_acc_no[0]" class="form-control" required>
                            </td>
                            <td colspan="3">
                                <label>GSB Branch</label>
                                <input type="text" name="gsb_branch[0]" class="form-control" required>
                            </td>
                        </tr>
                        <tr>
                            <td width="60">
                                <input type="checkbox" name="validity_january_0[0]" value="january">
                            </td>
                            <td style="text-align: right" width="150">
                                <label>January</label>
                            </td>
                            <td>
                                <input type="number" name="january[0]" style="border: 0; width: 100%; height: 100%;" value = "<?= $model->january=== null ? 0 : $model->january ?>" required>
                            </td>
                            <td>
                                <input type="checkbox" name="validity_july_0[0]" value="july">
                            </td>
                            <td style="text-align: right" width="150">
                                <label>July</label>
                            </td>
                            <td>
                                <input type="number" name="july[0]" class="form-control" value = "<?= $model->july === null ? 0 : $model->july ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="validity_february_0[0]" value="february">
                            </td>
                            <td style="text-align: right">
                                <label>February</label>
                            </td>
                            <td>
                                <input type="number" name="february[0]" class="form-control" value = "<?= $model->february=== null ? 0 : $model->february ?>" required>
                            </td>
                            <td>
                                <input type="checkbox" name="validity_august_0[0]" value="august">
                            </td>
                            <td style="text-align: right">
                                <label>August</label>
                            </td>
                            <td>
                                <input type="number" name="august[0]" class="form-control" value = "<?= $model->august=== null ? 0 : $model->august ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="validity_march_0[0]" value="march">
                            </td>
                            <td style="text-align: right">
                                <label>March</label>
                            </td>
                            <td>
                                <input type="number" name="march[0]" class="form-control" value = "<?= $model->march=== null ? 0 : $model->march ?>" required>
                            </td>
                            <td>
                                <input type="checkbox" name="validity_september_0[0]" value="september">
                            </td>
                            <td style="text-align: right">
                                <label>September</label>
                            </td>
                            <td>
                                <input type="number" name="september[0]" class="form-control" value = "<?= $model->september=== null ? 0 : $model->september ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-style: italic;" colspan="2">
                                <label>Sub-total (First Quarter)</label>
                            </td>
                            <td>
                                <input type="number" name="first_quarter[0]" class="form-control" value = "<?= $model->first_quarter=== null ? 0 : $model->first_quarter ?>" required>
                            </td>
                            <td style="font-style: italic;" colspan="2">
                                <label>Sub-total (Third Quarter)</label>
                            </td>
                            <td>
                                <input type="number" name="third_quarter[0]" class="form-control" value = "<?= $model->third_quarter=== null ? 0 : $model->third_quarter ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="validity_april_0[0]" value="april">
                            </td>
                            <td style="text-align: right">
                                <label>April</label>
                            </td>
                            <td>
                                <input type="number" name="april[0]" class="form-control" value = "<?= $model->april=== null ? 0 : $model->april ?>" required>
                            </td>
                            <td>
                                <input type="checkbox" name="validity_october_0[0]" value="october">
                            </td>
                            <td style="text-align: right">
                                <label>October</label>
                            </td>
                            <td>
                                <input type="number" name="october[0]" class="form-control" value = "<?= $model->october=== null ? 0 : $model->october ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="validity_may_0[0]" value="may">
                            </td>
                            <td style="text-align: right">
                                <label>May</label>
                            </td>
                            <td>
                                <input type="number" name="may[0]" class="form-control" value = "<?= $model->may=== null ? 0 : $model->may ?>" required>
                            </td>
                            <td>
                                <input type="checkbox" name="validity_november_0[0]" value="november">
                            </td>
                            <td style="text-align: right">
                                <label>November</label>
                            </td>
                            <td>
                                <input type="number" name="november[0]" class="form-control" value = "<?= $model->november=== null ? 0 : $model->november ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="validity_june_0[0]" value="june">
                            </td>
                            <td style="text-align: right">
                                <label>June</label>
                            </td>
                            <td>
                                <input type="number" name="june[0]" class="form-control" value = "<?= $model->june === null ? 0 : $model->june ?>" required>
                            </td>
                            <td>
                                <input type="checkbox" name="validity_december_0[0]" value="december">
                            </td>
                            <td style="text-align: right">
                                <label>December</label>
                            </td>
                            <td>
                                <input type="number" name="december[0]" class="form-control" value = "<?= $model->december=== null ? 0 : $model->december ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-style: italic;" colspan="2">
                                <label>Sub-total (Second Quarter)</label>
                            </td>
                            <td>
                                <input type="number" name="second_quarter[0]" class="form-control" value = "<?= $model->second_quarter=== null ? 0 : $model->second_quarter ?>" required>
                            </td>
                            <td style="font-style: italic;" colspan="2">
                                <label>Sub-total (Forth Quarter)</label>
                            </td>
                            <td>
                                <input type="number" name="forth_quarter[0]" class="form-control" value = "<?= $model->forth_quarter=== null ? 0 : $model->forth_quarter ?>" required>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    <div class="form-group" style="padding-left: 15px;">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<script>

var counter = 1;
var limit = 3;
function addInput(dynamicInput)
{
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
          var newdiv = document.createElement('table');
          newdiv.innerHTML = '<table><tr><td colspan="2"><label>Funding Source Code</label><input type="text" name="funding_source[0]" class="form-control" required></td><td><label>MDS Sub-account No.</label><input type="text" name="mds_sub_acc_no[0]" class="form-control" required></td><td colspan="3"><label>GSB Branch</label><input type="text" name="gsb_branch[0]" class="form-control" required></td></tr><tr><td width="60"><input type="checkbox" name="validity_january_0[0]" value="january"></td><td style="text-align: right" width="150"><label>January</label></td><td><input type="number" name="january[0]" class="form-control" value = "<?= $model->january=== null ? 0 : $model->january ?>" required></td><td><input type="checkbox" name="validity_july_0[0]" value="july"></td><td style="text-align: right" width="150"><label>July</label></td><td><input type="number" name="july[0]" class="form-control" value = "<?= $model->july === null ? 0 : $model->july ?>" required></td></tr><tr><td><input type="checkbox" name="validity_february_0[0]" value="february"></td><td style="text-align: right"><label>February</label></td><td><input type="number" name="february[0]" class="form-control" value = "<?= $model->february=== null ? 0 : $model->february ?>" required></td><td><input type="checkbox" name="validity_august_0[0]" value="august"></td><td style="text-align: right"><label>August</label></td><td><input type="number" name="august[0]" class="form-control" value = "<?= $model->august=== null ? 0 : $model->august ?>" required></td></tr><tr><td><input type="checkbox" name="validity_march_0[0]" value="march"></td><td style="text-align: right"><label>March</label></td><td><input type="number" name="march[0]" class="form-control" value = "<?= $model->march=== null ? 0 : $model->march ?>" required></td><td><input type="checkbox" name="validity_september_0[0]" value="september"></td><td style="text-align: right"><label>September</label></td><td><input type="number" name="september[0]" class="form-control" value = "<?= $model->september=== null ? 0 : $model->september ?>" required></td></tr><tr><td style="font-style: italic;" colspan="2"><label>Sub-total (First Quarter)</label></td><td><input type="number" name="first_quarter[0]" class="form-control" value = "<?= $model->first_quarter=== null ? 0 : $model->first_quarter ?>" required></td><td style="font-style: italic;" colspan="2"><label>Sub-total (Third Quarter)</label></td><td><input type="number" name="third_quarter[0]" class="form-control" value = "<?= $model->third_quarter=== null ? 0 : $model->third_quarter ?>" required></td></tr><tr><td><input type="checkbox" name="validity_april_0[0]" value="april"></td><td style="text-align: right"><label>April</label></td><td><input type="number" name="april[0]" class="form-control" value = "<?= $model->april=== null ? 0 : $model->april ?>" required></td><td><input type="checkbox" name="validity_october_0[0]" value="october"></td><td style="text-align: right"><label>October</label></td><td><input type="number" name="october[0]" class="form-control" value = "<?= $model->october=== null ? 0 : $model->october ?>" required></td></tr><tr><td><input type="checkbox" name="validity_may_0[0]" value="may"></td><td style="text-align: right"><label>May</label></td><td><input type="number" name="may[0]" class="form-control" value = "<?= $model->may=== null ? 0 : $model->may ?>" required></td><td><input type="checkbox" name="validity_november_0[0]" value="november"></td><td style="text-align: right"><label>November</label></td><td><input type="number" name="november[0]" class="form-control" value = "<?= $model->november=== null ? 0 : $model->november ?>" required></td></tr><tr><td><input type="checkbox" name="validity_june_0[0]" value="june"></td><td style="text-align: right"><label>June</label></td><td><input type="number" name="june[0]" class="form-control" value = "<?= $model->june === null ? 0 : $model->june ?>" required></td><td><input type="checkbox" name="validity_december_0[0]" value="december"></td><td style="text-align: right"><label>December</label></td><td><input type="number" name="december[0]" class="form-control" value = "<?= $model->december=== null ? 0 : $model->december ?>" required></td></tr><tr><td style="font-style: italic;" colspan="2"><label>Sub-total (Second Quarter)</label></td><td><input type="number" name="second_quarter[0]" class="form-control" value = "<?= $model->second_quarter=== null ? 0 : $model->second_quarter ?>" required></td><td style="font-style: italic;" colspan="2"><label>Sub-total (Forth Quarter)</label></td><td><input type="number" name="forth_quarter[0]" class="form-control" value = "<?= $model->forth_quarter=== null ? 0 : $model->forth_quarter ?>" required></td></tr></table>';

          document.getElementById("dynamicInput").appendChild(newdiv).className = "table table-bordered my-table";
          counter++;
     }
}

</script>