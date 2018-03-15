<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\FundCluster;
use backend\models\Nca;

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
            </tr>
            <tr>
                <td><?= $form->field($model, 'nca_type')->textInput(['maxlength' => true]) ?></td>
                <td><?= $form->field($model, 'total_amount')->textInput(['maxlength' => true]) ?></td>
            </tr>
            <tr>
                <td colspan="4" style="background-color: #f5f5f0">
                   <strong>MONTHLY REQUIREMENTS SCHEDULE</strong>
                   <!-- <button class="btn btn-success btn-right" type="button" onClick="addInput('dynamicInput')" ><i class="glyphicon glyphicon-plus"></i></button> -->
                </td>
            </tr>
            <tr>
                <td colspan="4" id="dynamicInput">
                    <?php foreach ($annexes as $key => $value) : ?>
                        <table class="table table-bordered" style="width: 97%; margin-right: auto; margin-left: auto; padding: 10px;">
                            <tr>
                                <td colspan="2">
                                    <input type="hidden" name="id[<?= $key ?>]" value="<?= $value->id ?>">
                                    <label>Funding Source Code</label>
                                    <input type="text" name="funding_source[<?= $key ?>]" class="form-control" value="<?= $value->funding_source != null ? $value->funding_source : '0.00' ?>" required>
                                </td>
                                <td>
                                    <label>MDS Sub-account No.</label>
                                    <input type="text" name="mds_sub_acc_no[<?= $key ?>]" class="form-control" value="<?= $value->mds_sub_acc_no != null ? $value->mds_sub_acc_no : '0.00' ?>" required>
                                </td>
                                <td colspan="3">
                                    <label>GSB Branch</label>
                                    <input type="text" name="gsb_branch[<?= $key ?>]" class="form-control" value="<?= $value->gsb_branch != null ? $value->gsb_branch : '0.00' ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td width="60">
                                    <input type="checkbox" name="validity_<?= $key ?>[]" class="first" value="january" <?= Nca::find()->where(['funding_source' => $value->funding_source])->andWhere(['like', 'validity', 'january'])->one() != null ? "checked" : " " ?> >
                                </td>
                                <td style="text-align: right" width="150">
                                    <label>January</label>
                                </td>
                                <td>
                                    <input type="number" name="january[<?= $key ?>]" class="form-control" value="<?= $value->january != null ? $value->january : '0.00' ?>" required>
                                </td>
                                <td>
                                    <input type="checkbox" name="validity_<?= $key ?>[]" class="third" value="july" <?= Nca::find()->where(['funding_source' => $value->funding_source])->andWhere(['like', 'validity', 'july'])->one() != null ? "checked" : " " ?> >
                                </td>
                                <td style="text-align: right" width="150">
                                    <label>July</label>
                                </td>
                                <td>
                                    <input type="number" name="july[<?= $key ?>]" class="form-control" value="<?= $value->july != null ? $value->july : '0.00' ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="validity_<?= $key ?>[]" class="first" value="february" <?= Nca::find()->where(['funding_source' => $value->funding_source])->andWhere(['like', 'validity', 'february'])->one() != null ? "checked" : " " ?>>
                                </td>
                                <td style="text-align: right">
                                    <label>February</label>
                                </td>
                                <td>
                                    <input type="number" name="february[<?= $key ?>]" class="form-control" value="<?= $value->february != null ? $value->february : '0.00' ?>" required>
                                </td>
                                <td>
                                    <input type="checkbox" name="validity_<?= $key ?>[]" class="third" value="august" <?= Nca::find()->where(['funding_source' => $value->funding_source])->andWhere(['like', 'validity', 'august'])->one() != null ? "checked" : " " ?> >
                                </td>
                                <td style="text-align: right">
                                    <label>August</label>
                                </td>
                                <td>
                                    <input type="number" name="august[<?= $key ?>]" class="form-control" value="<?= $value->august != null ? $value->august : '0.00' ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="validity_<?= $key ?>[]" class="first" value="march" <?= Nca::find()->where(['funding_source' => $value->funding_source])->andWhere(['like', 'validity', 'march'])->one() != null ? "checked" : " " ?> >
                                </td>
                                <td style="text-align: right">
                                    <label>March</label>
                                </td>
                                <td>
                                    <input type="number" name="march[<?= $key ?>]" class="form-control" value="<?= $value->march != null ? $value->march : '0.00' ?>" required>
                                </td>
                                <td>
                                    <input type="checkbox" name="validity_<?= $key ?>[]" class="third" value="september" <?= Nca::find()->where(['funding_source' => $value->funding_source])->andWhere(['like', 'validity', 'september'])->one() != null ? "checked" : " " ?> >
                                </td>
                                <td style="text-align: right">
                                    <label>September</label>
                                </td>
                                <td>
                                    <input type="number" name="september[<?= $key ?>]" class="form-control" value="<?= $value->september != null ? $value->september : '0.00' ?>" required />
                                </td>
                            </tr>
                            <tr>
                                <td style="font-style: italic;" colspan="2">
                                    <!-- <input type="checkbox" id="selectallfirst" />
                                    <label for="selectallfirst" id="selectControl">Select</label> -->
                                    <label>First Quarter (Sub-total)</label>
                                </td>
                                <td>
                                    <input type="number" name="first_quarter[<?= $key ?>]" class="form-control" value="<?= $value->first_quarter != null ? $value->first_quarter : '0.00' ?>" required>
                                </td>
                                <td style="font-style: italic;" colspan="2">
                                    <!-- <input type="checkbox" id="selectallthird" />
                                    <label for="selectallthird" id="selectControl3">Select</label> -->
                                    <label>Third Quarter (Sub-total)</label>
                                </td>
                                <td>
                                    <input type="number" name="third_quarter[<?= $key ?>]" class="form-control" value = "<?= $value->third_quarter != null ? $value->third_quarter : '0.00' ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="validity_<?= $key ?>[]" class="second" value="april" <?= Nca::find()->where(['funding_source' => $value->funding_source])->andWhere(['like', 'validity', 'april'])->one() != null ? "checked" : " " ?> >
                                </td>
                                <td style="text-align: right">
                                    <label>April</label>
                                </td>
                                <td>
                                    <input type="number" name="april[<?= $key ?>]" class="form-control" value="<?= $value->april != null ? $value->april : '0.00' ?>" required>
                                </td>
                                <td>
                                    <input type="checkbox" name="validity_<?= $key ?>[]" class="forth" value="october" <?= Nca::find()->where(['funding_source' => $value->funding_source])->andWhere(['like', 'validity', 'october'])->one() != null ? "checked" : " " ?> >
                                </td>
                                <td style="text-align: right">
                                    <label>October</label>
                                </td>
                                <td>
                                    <input type="number" name="october[<?= $key ?>]" class="form-control" value="<?= $value->october != null ? $value->october : '0.00' ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="validity_<?= $key ?>[]" class="second" value="may" <?= Nca::find()->where(['funding_source' => $value->funding_source])->andWhere(['like', 'validity', 'may'])->one() != null ? "checked" : " " ?> >
                                </td>
                                <td style="text-align: right">
                                    <label>May</label>
                                </td>
                                <td>
                                    <input type="number" name="may[<?= $key ?>]" class="form-control" value="<?= $value->may != null ? $value->may : '0.00' ?>" required>
                                </td>
                                <td>
                                    <input type="checkbox" name="validity_<?= $key ?>[]" class="forth" value="november" <?= Nca::find()->where(['funding_source' => $value->funding_source])->andWhere(['like', 'validity', 'november'])->one() != null ? "checked" : " " ?> >
                                </td>
                                <td style="text-align: right">
                                    <label>November</label>
                                </td>
                                <td>
                                    <input type="number" name="november[<?= $key ?>]" class="form-control" value="<?= $value->november != null ? $value->november : '0.00' ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="validity_<?= $key ?>[]" class="second" value="june" <?= Nca::find()->where(['funding_source' => $value->funding_source])->andWhere(['like', 'validity', 'june'])->one() != null ? "checked" : " " ?> >
                                </td>
                                <td style="text-align: right">
                                    <label>June</label>
                                </td>
                                <td>
                                    <input type="number" name="june[<?= $key ?>]" class="form-control" value="<?= $value->june != null ? $value->june : '0.00' ?>" required>
                                </td>
                                <td>
                                    <input type="checkbox" name="validity_<?= $key ?>[]" class="forth" value="december" <?= Nca::find()->where(['funding_source' => $value->funding_source])->andWhere(['like', 'validity', 'december'])->one() != null ? "checked" : " " ?> >
                                </td>
                                <td style="text-align: right">
                                    <label>December</label>
                                </td>
                                <td>
                                    <input type="number" name="december[<?= $key ?>]" class="form-control" value="<?= $value->december != null ? $value->december : '0.00' ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-style: italic;" colspan="2">
                                    <!-- <input type="checkbox" id="selectallsecond" />
                                    <label for="selectallsecond" id="selectControl2">Select</label> -->
                                    <label> Second Quarter(Sub-total)</label>
                                </td>
                                <td>
                                    <input type="number" name="second_quarter[<?= $key ?>]" class="form-control" value = "<?= $value->second_quarter != null ? $value->second_quarter : '0.00' ?>" required>
                                </td>
                                <td style="font-style: italic;" colspan="2">
                                    <!-- <input type="checkbox" id="selectallforth" />
                                    <label for="selectallforth" id="selectControl4">Select</label> -->
                                    <label>Forth Quarter(Sub-total)</label>
                                </td>
                                <td>
                                    <input type="number" name="forth_quarter[<?= $key ?>]" class="form-control" value = "<?= $value->forth_quarter != null ? $value->forth_quarter : '0.00' ?>" required>
                                </td>
                            </tr>
                        </table>
                    <?php endforeach ?>
                </td>
            </tr>
        </table>
    <div class="form-group" style="padding-left: 15px;">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<script lang="JavaScript">

var counter = 1;
var limit = 3;
function addInput(dynamicInput)
{
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
          var newdiv = document.createElement('table');
          newdiv.innerHTML = '<table><tr><td colspan="2"><label>Funding Source Code</label><input type="text" name="funding_source['+counter+']" class="form-control" required></td><td><label>MDS Sub-account No.</label><input type="text" name="mds_sub_acc_no['+counter+']" class="form-control" required></td><td colspan="3"><label>GSB Branch</label><input type="text" name="gsb_branch['+counter+']" class="form-control" required></td></tr><tr><td width="60"><input type="checkbox" name="validity_'+counter+'[]" value="january"></td><td style="text-align: right" width="150"><label>January</label></td><td><input type="number" name="january['+counter+']" class="form-control" value = "<?= $model->january=== null ? 0 : $model->january ?>" required></td><td><input type="checkbox" name="validity_'+counter+'[]" value="july"></td><td style="text-align: right" width="150"><label>July</label></td><td><input type="number" name="july['+counter+']" class="form-control" value = "<?= $model->july === null ? 0 : $model->july ?>" required></td></tr><tr><td><input type="checkbox" name="validity_'+counter+'[]" value="february"></td><td style="text-align: right"><label>February</label></td><td><input type="number" name="february['+counter+']" class="form-control" value = "<?= $model->february=== null ? 0 : $model->february ?>" required></td><td><input type="checkbox" name="validity_'+counter+'[]" value="august"></td><td style="text-align: right"><label>August</label></td><td><input type="number" name="august['+counter+']" class="form-control" value = "<?= $model->august=== null ? 0 : $model->august ?>" required></td></tr><tr><td><input type="checkbox" name="validity_'+counter+'[]" value="march"></td><td style="text-align: right"><label>March</label></td><td><input type="number" name="march['+counter+']" class="form-control" value = "<?= $model->march=== null ? 0 : $model->march ?>" required></td><td><input type="checkbox" name="validity_'+counter+'[]" value="september"></td><td style="text-align: right"><label>September</label></td><td><input type="number" name="september['+counter+']" class="form-control" value = "<?= $model->september=== null ? 0 : $model->september ?>" required></td></tr><tr><td style="font-style: italic;" colspan="2"><label>Sub-total (First Quarter)</label></td><td><input type="number" name="first_quarter['+counter+']" class="form-control" value = "<?= $model->first_quarter=== null ? 0 : $model->first_quarter ?>" required></td><td style="font-style: italic;" colspan="2"><label>Sub-total (Third Quarter)</label></td><td><input type="number" name="third_quarter['+counter+']" class="form-control" value = "<?= $model->third_quarter=== null ? 0 : $model->third_quarter ?>" required></td></tr><tr><td><input type="checkbox" name="validity_'+counter+'[]" value="april"></td><td style="text-align: right"><label>April</label></td><td><input type="number" name="april['+counter+']" class="form-control" value = "<?= $model->april=== null ? 0 : $model->april ?>" required></td><td><input type="checkbox" name="validity_'+counter+'[]" value="october"></td><td style="text-align: right"><label>October</label></td><td><input type="number" name="october['+counter+']" class="form-control" value = "<?= $model->october=== null ? 0 : $model->october ?>" required></td></tr><tr><td><input type="checkbox" name="validity_'+counter+'[]" value="may"></td><td style="text-align: right"><label>May</label></td><td><input type="number" name="may['+counter+']" class="form-control" value = "<?= $model->may=== null ? 0 : $model->may ?>" required></td><td><input type="checkbox" name="validity_'+counter+'[]" value="november"></td><td style="text-align: right"><label>November</label></td><td><input type="number" name="november['+counter+']" class="form-control" value = "<?= $model->november=== null ? 0 : $model->november ?>" required></td></tr><tr><td><input type="checkbox" name="validity_'+counter+'[]" value="june"></td><td style="text-align: right"><label>June</label></td><td><input type="number" name="june['+counter+']" class="form-control" value = "<?= $model->june === null ? 0 : $model->june ?>" required></td><td><input type="checkbox" name="validity_'+counter+'[]" value="december"></td><td style="text-align: right"><label>December</label></td><td><input type="number" name="december['+counter+']" class="form-control" value = "<?= $model->december=== null ? 0 : $model->december ?>" required></td></tr><tr><td style="font-style: italic;" colspan="2"><label>Sub-total (Second Quarter)</label></td><td><input type="number" name="second_quarter['+counter+']" class="form-control" value = "<?= $model->second_quarter=== null ? 0 : $model->second_quarter ?>" required></td><td style="font-style: italic;" colspan="2"><label>Sub-total (Forth Quarter)</label></td><td><input type="number" name="forth_quarter['+counter+']" class="form-control" value = "<?= $model->forth_quarter=== null ? 0 : $model->forth_quarter ?>" required></td></tr></table>';

          document.getElementById("dynamicInput").appendChild(newdiv).className = "table table-bordered my-table";
          counter++;
     }
}

function Check(frm)
{
   //var checkBoxes = frm.elements['validity_0[]'];
    //var checkBoxes = document.getElementsByName('validity_0[]');
  var checkBoxes = document.getElementsByClassName('first');
  console.log(checkBoxes);

  for (i = 0; i < checkBoxes.length; i++)
  { 
    checkBoxes[i].checked = (selectControl.innerHTML == "Select") ? 'checked' : '';
  }
  selectControl.innerHTML = (selectControl.innerHTML == "Select") ? "Unselect" : 'Select';
}

window.onload = function()
{
  var selectControl = document.getElementById("selectallfirst");
  selectControl.onclick = function()
  {
        Check(document.ActiveForm)
  };

  var selectControl2 = document.getElementById("selectallsecond");
  selectControl2.onclick = function()
  {
        Check2(document.ActiveForm)
  };

  var selectControl3 = document.getElementById("selectallthird");
  selectControl3.onclick = function()
  {
        Check3(document.ActiveForm)
  };

  var selectControl4 = document.getElementById("selectallforth");
  selectControl4.onclick = function()
  {
        Check4(document.ActiveForm)
  };

};

function Check2(frm)
{
   //var checkBoxes = frm.elements['validity_0[]'];
    //var checkBoxes = document.getElementsByName('validity_0[]');
  var checkBoxes2 = document.getElementsByClassName('second');
  console.log(checkBoxes2);

  for (i = 0; i < checkBoxes2.length; i++)
  { 
    checkBoxes2[i].checked = (selectControl2.innerHTML == "Select") ? 'checked' : '';
  }
  selectControl2.innerHTML = (selectControl2.innerHTML == "Select") ? "Unselect" : 'Select';
}

function Check3(frm)
{
   //var checkBoxes = frm.elements['validity_0[]'];
    //var checkBoxes = document.getElementsByName('validity_0[]');
  var checkBoxes3 = document.getElementsByClassName('third');
  console.log(checkBoxes3);

  for (i = 0; i < checkBoxes3.length; i++)
  { 
    checkBoxes3[i].checked = (selectControl3.innerHTML == "Select") ? 'checked' : '';
  }
  selectControl3.innerHTML = (selectControl3.innerHTML == "Select") ? "Unselect" : 'Select';
}

function Check4(frm)
{
   //var checkBoxes = frm.elements['validity_0[]'];
    //var checkBoxes = document.getElementsByName('validity_0[]');
  var checkBoxes4 = document.getElementsByClassName('forth');
  console.log(checkBoxes4);

  for (i = 0; i < checkBoxes4.length; i++)
  { 
    checkBoxes4[i].checked = (selectControl4.innerHTML == "Select") ? 'checked' : '';
  }
  selectControl4.innerHTML = (selectControl4.innerHTML == "Select") ? "Unselect" : 'Select';
}



</script>