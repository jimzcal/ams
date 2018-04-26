<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Far101;
use backend\models\MfoPap;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Far101 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="far101-form">

    <div class="title">
        <div class="btn btn-success btn-right" data-toggle="modal" data-target="#myModal">Add Particular</div>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <table style="width: 100%;">
            <tr style="height: 60px;">
                <th colspan="4" style="text-align: center; font-size: 18px;">
                    STATEMENT OF OBLIGATIONS AND DISBURSEMENTS
                </th>
            </tr>
            <tr>
                <td style="width: 160px;">Department</td>
                <td style="width: 30px;">:</td>
                <td style="font-weight: bold; width: 300px;">Department of Agriculture</td>
                <td></td>
            </tr>
            <tr>
                <td style="width: 160px;">Agency</td>
                <td style="width: 30px;">:</td>
                <td style="font-weight: bold; width: 300px;">Office of the Secretary</td>
                <td></td>
            </tr>
            <tr>
                <td style="width: 160px;">Operating Unit</td>
                <td style="width: 30px;">:</td>
                <td style="font-weight: bold; width: 300px;">Central Office</td>
                <td></td>
            </tr>
            <tr>
                <td style="width: 160px;">Organization Code</td>
                <td style="width: 30px;">:</td>
                <td style="font-weight: bold;">050010100000</td>
                <td></td>
            </tr>
            <tr>
                <td style="width: 160px;">Fiscal Year</td>
                <td style="width: 30px;">:</td>
                <td style="font-weight: bold;">
                    <?= $fiscal_year ?>
                </td>
                <td></td>
            </tr>
            <tr>
                <td style="width: 160px;">Funding Source Code</td>
                <td style="width: 30px;">:</td>
                <td style="font-weight: bold;">
                    <?= $fund_cluster ?>
                </td>
                <td></td>
            </tr>
        </table>
        <br>
        <table class="table table-bordered">
            <tr>
                <th rowspan="2" style="width: 330px; text-align: center;">PARTICULARS</th>
                <th rowspan="2" style="width: 160px; text-align: center;">UACS CODE</th>
                <th colspan="5" style="text-align: center">CURRENT YEAR OBLIGATIONS</th>
                <th colspan="5" style="text-align: center">CURRENT YEAR DISBURSEMENTS</th>
            </tr>
            <tr>
                <td style="font-size: 11px; text-align: center">1st Quarter</td>
                <td style="font-size: 11px; text-align: center">2nd Quarter</td>
                <td style="font-size: 11px; text-align: center">3rd Quarter</td>
                <td style="font-size: 11px; text-align: center">4th Quarter</td>
                <td style="font-size: 11px; text-align: center">Total Obligations</td>
                <td style="font-size: 11px; text-align: center">1st Quarter</td>
                <td style="font-size: 11px; text-align: center">2nd Quarter</td>
                <td style="font-size: 11px; text-align: center">3rd Quarter</td>
                <td style="font-size: 11px; text-align: center">4th Quarter</td>
                <td style="font-size: 11px; text-align: center">Total Disbursement</td>
            </tr>
            <?php foreach ($far as $value) : ?>
            <tr>
                <td><?= $value->particulars ?></td>
                <td><?= $value->uacs_code ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
                <?php $sub_far = Far101::find()->where(['parent_id' => $value->id])->all(); ?>
                <?php foreach ($sub_far as $val) : ?>
                    <tr>
                        <td style="text-indent: 10px;"><?= $val->particulars ?></td>
                        <td><?= $val->uacs_code ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                        <?php $sub_far2 = Far101::find()->where(['parent_id' => $val->id])->all(); ?>
                        <?php foreach ($sub_far2 as $data) : ?>
                            <tr>
                                <td style="text-indent: 20px;"><?= $data->particulars ?></td>
                                <td><?= $data->uacs_code ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                                <?php $sub_far3 = Far101::find()->where(['parent_id' => $data->id])->all(); ?>
                                <?php foreach ($sub_far3 as $data4) : ?>
                                    <tr>
                                        <td style="text-indent: 30px;"><?= $data4->particulars ?></td>
                                        <td><?= $data4->uacs_code ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php $sub_far4 = Far101::find()->where(['parent_id' => $data4->id])->all(); ?>
                                        <?php foreach ($sub_far4 as $data5) : ?>
                                            <tr>
                                                <td style="text-indent: 40px;"><?= $data5->particulars ?></td>
                                                <td><?= $data5->uacs_code ?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        <?php endforeach ?>
                                <?php endforeach ?>
                        <?php endforeach ?>
                <?php endforeach ?>
        <?php endforeach ?>
        </table>

    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
             <h4 class="modal-title">Add Particular</h4>
          </div>
          <div class="modal-body">
            <table width="500">
                <tr>
                    <td>
                        <?= $form->field($model, 'fiscal_year')->textInput(['maxlength' => true, 'style' => 'width: 95%', 'value' => $fiscal_year, 'readonly' => true]) ?>
                    </td>
                </tr>     
                <tr>
                    <td><?= $form->field($model, 'fund_cluster')->textInput(['maxlength' => true, 'style' => 'width: 95%', 'value' => $fund_cluster, 'readonly' => true]) ?></td>
                </tr>
                <tr>
                    <td><?= $form->field($model, 'parent_id')->dropDownList(['0'=>'none', ArrayHelper::map(Far101::find()
                            ->where(['fiscal_year' => $fiscal_year])
                            ->andWhere(['fund_cluster' => $fund_cluster])
                            ->all(),'id', 'uacs_code')], ['style' => 'width: 95%']) ?>
                    </td>
                </tr>
                <tr>
                    <td><?= $form->field($model, 'particulars')->textInput(['maxlength' => true, 'style' => 'width: 95%']) ?></td>
                </tr>
                <tr>
                    <td>
                        <?= $form->field($model, 'uacs_code')->dropDownList([ArrayHelper::map(MfoPap::find()->all(),'uacs', 'uacs')], ['style' => 'width: 95%']) ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?= $form->field($model, 'date_updated')->hiddenInput(['maxlength' => true, 'style' => 'width: 95%', 'value' => date('M. d, Y'), 'readonly' => true])->label(false) ?>
                    </td>
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

<!-- <script>
(function()
{
  if( window.localStorage )
  {
    if( !localStorage.getItem('firstLoad') )
    {
      localStorage['firstLoad'] = true;
      window.location.reload();
    }  
    else
      localStorage.removeItem('firstLoad');
  }
})();
</script> -->
