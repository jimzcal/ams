<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\FundCluster;
use kartik\select2\Select2;
use backend\models\FundingSource;

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
                    <?= $form->field($model, 'fiscal_year')->dropDownList([date("Y") => date("Y"), (date("Y")+1) => (date("Y")+1)]) ?>
                </td>
            </tr>
            <tr>
                <td><?= $form->field($model, 'nca_type')->textInput(['maxlength' => true]) ?></td>
                <td><?= $form->field($model, 'total_amount')->textInput(['maxlength' => true, 'id' => 'grandTotal']) ?></td>
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
                                <!-- <input type="text" name="funding_source[0]" class="form-control" required> -->
                                <?= $form->field($model, 'fund_cluster')->dropDownList(ArrayHelper::map(FundingSource::find()->all(),'uacs','uacs'),
                                    [
                                        'prompt'=>'Select Funding Source',
                                    ])->label(false); 
                                ?>
                                <!-- <input list="funding_source" name="funding_source[0]" class="form-control" required> -->
                                <datalist id="funding_source">
                                    <?php foreach ($data as $value) : ?>
                                        <option value=<?= $value->uacs ?>>
                                    <?php endforeach ?>
                                </datalist>
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
                                <input type="checkbox" name="validity_0[]" class="first" value="january">
                            </td>
                            <td style="text-align: right" width="150">
                                <label>January</label>
                            </td>
                            <td>
                                <input type="number" name="january[0]" class="form-control firstInput v" value = "<?= $model->january=== null ? 0 : $model->january ?>" required>
                            </td>
                            <td>
                                <input type="checkbox" name="validity_0[]" class="third" value="july">
                            </td>
                            <td style="text-align: right" width="150">
                                <label>July</label>
                            </td>
                            <td>
                                <input type="number" name="july[0]" class="form-control thirdInput v" value = "<?= $model->july === null ? 0 : $model->july ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="validity_0[]" class="first" value="february">
                            </td>
                            <td style="text-align: right">
                                <label>February</label>
                            </td>
                            <td>
                                <input type="number" name="february[0]" class="form-control firstInput v" value = "<?= $model->february=== null ? 0 : $model->february ?>" required>
                            </td>
                            <td>
                                <input type="checkbox" name="validity_0[]" class="third" value="august">
                            </td>
                            <td style="text-align: right">
                                <label>August</label>
                            </td>
                            <td>
                                <input type="number" name="august[0]" class="form-control thirdInput v" value = "<?= $model->august=== null ? 0 : $model->august ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="validity_0[]" class="first" value="march">
                            </td>
                            <td style="text-align: right">
                                <label>March</label>
                            </td>
                            <td>
                                <input type="number" name="march[0]" class="form-control firstInput v" value = "<?= $model->march=== null ? 0 : $model->march ?>" required>
                            </td>
                            <td>
                                <input type="checkbox" name="validity_0[]" class="third" value="september">
                            </td>
                            <td style="text-align: right">
                                <label>September</label>
                            </td>
                            <td>
                                <input type="number" name="september[0]" class="form-control thirdInput v" value = "<?= $model->september=== null ? 0 : $model->september ?>" required />
                            </td>
                        </tr>
                        <tr>
                            <td style="font-style: italic;" colspan="2">
                                <input type="checkbox" id="selectallfirst" />
                                <label for="selectallfirst" id="selectControl">Select</label>
                                <label>First Quarter (Sub-total)</label>
                            </td>
                            <td>
                                <input type="number" name="first_quarter[0]" class="form-control" id="totalFirst" value = "<?= $model->first_quarter=== null ? 0 : $model->first_quarter ?>" required>
                            </td>
                            <td style="font-style: italic;" colspan="2">
                                <input type="checkbox" id="selectallthird" />
                                <label for="selectallthird" id="selectControl3">Select</label>
                                <label>Third Quarter (Sub-total)</label>
                            </td>
                            <td>
                                <input type="number" name="third_quarter[0]" class="form-control" id="totalThird" value = "<?= $model->third_quarter=== null ? 0 : $model->third_quarter ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="validity_0[]" class="second" value="april">
                            </td>
                            <td style="text-align: right">
                                <label>April</label>
                            </td>
                            <td>
                                <input type="number" name="april[0]" class="form-control secondInput v" value = "<?= $model->april=== null ? 0 : $model->april ?>" required>
                            </td>
                            <td>
                                <input type="checkbox" name="validity_0[]" class="forth" value="october">
                            </td>
                            <td style="text-align: right">
                                <label>October</label>
                            </td>
                            <td>
                                <input type="number" name="october[0]" class="form-control forthInput v" value = "<?= $model->october=== null ? 0 : $model->october ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="validity_0[]" class="second" value="may">
                            </td>
                            <td style="text-align: right">
                                <label>May</label>
                            </td>
                            <td>
                                <input type="number" name="may[0]" class="form-control secondInput v" value = "<?= $model->may=== null ? 0 : $model->may ?>" required>
                            </td>
                            <td>
                                <input type="checkbox" name="validity_0[]" class="forth" value="november">
                            </td>
                            <td style="text-align: right">
                                <label>November</label>
                            </td>
                            <td>
                                <input type="number" name="november[0]" class="form-control forthInput v" value = "<?= $model->november=== null ? 0 : $model->november ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="validity_0[]" class="second" value="june">
                            </td>
                            <td style="text-align: right">
                                <label>June</label>
                            </td>
                            <td>
                                <input type="number" name="june[0]" class="form-control secondInput v" value = "<?= $model->june === null ? 0 : $model->june ?>" required>
                            </td>
                            <td>
                                <input type="checkbox" name="validity_0[]" class="forth" value="december">
                            </td>
                            <td style="text-align: right">
                                <label>December</label>
                            </td>
                            <td>
                                <input type="number" name="december[0]" class="form-control forthInput v" value = "<?= $model->december=== null ? 0 : $model->december ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-style: italic;" colspan="2">
                                <input type="checkbox" id="selectallsecond" />
                                <label for="selectallsecond" id="selectControl2">Select</label>
                                <label> Second Quarter(Sub-total)</label>
                            </td>
                            <td>
                                <input type="number" name="second_quarter[0]" class="form-control" id="totalSecond" value = "<?= $model->second_quarter=== null ? 0 : $model->second_quarter ?>" required>
                            </td>
                            <td style="font-style: italic;" colspan="2">
                                <input type="checkbox" id="selectallforth" />
                                <label for="selectallforth" id="selectControl4">Select</label>
                                <label>Forth Quarter(Sub-total)</label>
                            </td>
                            <td>
                                <input type="number" name="forth_quarter[0]" class="form-control" id="totalForth" value = "<?= $model->forth_quarter=== null ? 0 : $model->forth_quarter ?>" required>
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

  $(".firstInput").each(function() {

            $(this).keyup(function(){
                calculateSum();
            });
        });

    function calculateSum() {

        var sum = 0;
        //iterate through each textboxes and add the values
        $(".firstInput").each(function() {

            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }

        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("#totalFirst").val(sum.toFixed(2));
    }

    $(".secondInput").each(function() 
    {

            $(this).keyup(function(){
                calculateSum2();
            });
        });

    function calculateSum2() {

        var sum = 0;
        //iterate through each textboxes and add the values
        $(".secondInput").each(function() {

            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }

        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("#totalSecond").val(sum.toFixed(2));
    }

    $(".thirdInput").each(function() {

            $(this).keyup(function(){
                calculateSum3();
            });
        });

    function calculateSum3() {

        var sum = 0;
        //iterate through each textboxes and add the values
        $(".thirdInput").each(function() {

            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }

        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("#totalThird").val(sum.toFixed(2));
    }

    $(".forthInput").each(function() {

            $(this).keyup(function(){
                calculateSum4();
            });
        });

    function calculateSum4() {

        var sum = 0;
        //iterate through each textboxes and add the values
        $(".forthInput").each(function() {

            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }

        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("#totalForth").val(sum.toFixed(2));
    }

    $(".v").each(function() {

            $(this).change(function(){
                calculateSum5();
            });
        });

    function calculateSum5() {

        var sum = 0;
        //iterate through each textboxes and add the values
        $(".v").each(function() {

            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }

        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("#grandTotal").val(sum.toFixed(2));
    }

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