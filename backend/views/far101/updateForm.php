<?php

use yii\helpers\Html;
use backend\models\Far101;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\OrsRegistry;
use backend\models\FundCluster;

/* @var $this yii\web\View */
/* @var $model backend\models\Far101 */

$this->title = 'FAR 1 - '.$model->fund_cluster;
// $this->params['breadcrumbs'][] = ['label' => 'Far101s', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="far101-view">
    <?php $form = ActiveForm::begin(); ?>
        <table style="width: 100%;">
                <tr style="height: 60px;">
                    <th colspan="4" style="text-align: center; font-size: 18px;">
                        STATEMENT OF CURRENT YEAR DISBURSEMENTS BY MFO-PAP
                        <p style="font-size: 16px;">As of <?= $model->date_updated; ?></p>
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
                    <td style="width: 160px; vertical-align: text-top;">Fiscal Year</td>
                    <td style="width: 30px; vertical-align: text-top;">:</td>
                    <td style="font-weight: bold;">
                        <?= $form->field($model, 'fiscal_year')->dropDownList(['2017'=>'2017', '2018' => '2018', '2019' => '2019', '2020' => '2020'],['class' => 'textfield'])->label(false) ?></td>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td style="width: 160px; vertical-align: text-top;">Fund Cluster</td>
                    <td style="width: 30px; vertical-align: text-top;">:</td>
                    <td style="font-weight: bold;">
                        <?= $form->field($model, 'fund_cluster')->dropDownList(ArrayHelper::map(FundCluster::find()->all(),'fund_cluster', 'fund_cluster'), ['class' => 'textfield'])->label(false);
                        ?>
                    </td>
                    <td></td>
                </tr>
            </table>
            <br>
            <table class="table table-bordered table-condensed">
                <tr>
                    <th rowspan="2" style="width: 390px; text-align: center;">PARTICULARS</th>
                    <th rowspan="2" style="width: 160px; text-align: center;">UACS CODE</th>
                    <!-- <th colspan="5" style="text-align: center">CURRENT YEAR OBLIGATIONS</th> -->
                    <th colspan="5" style="text-align: center">CURRENT YEAR DISBURSEMENTS</th>
                </tr>
                <tr>
                    <!-- <td style="font-size: 11px; text-align: center">1st Quarter</td>
                    <td style="font-size: 11px; text-align: center">2nd Quarter</td>
                    <td style="font-size: 11px; text-align: center">3rd Quarter</td>
                    <td style="font-size: 11px; text-align: center">4th Quarter</td>
                    <td style="font-size: 11px; text-align: center">Total Obligations</td> -->
                    <td style="font-size: 11px; text-align: center">1st Quarter</td>
                    <td style="font-size: 11px; text-align: center">2nd Quarter</td>
                    <td style="font-size: 11px; text-align: center">3rd Quarter</td>
                    <td style="font-size: 11px; text-align: center">4th Quarter</td>
                    <td style="font-size: 11px; text-align: center">Total Disbursement</td>
                </tr>
                <?php foreach ($far as $value) : ?>
                <tr>
                    <td>
                       <?= $form->field($model, 'id[]', ['options' => ['tag' => false]])->hiddenInput(['value' => $value->id, 'class' => 'textfield'])->label(false) ?>
                        
                       <?= $form->field($model, 'particulars[]', ['options' => ['tag' => false]])->textInput(['value' => $value->particulars, 'class' => 'textfield'])->label(false) ?>
                    </td>
                    <td>
                        <?= $form->field($model, 'uacs_code[]', ['options' => ['tag' => false]])->textInput(['value' => $value->uacs_code, 'class' => 'textfield'])->label(false) ?>
                    </td>
                    <!-- <td>
                        <input type="text" name="obligation_q_1[]" class="textfield" value="<?= $value->obligation_q_1 ?>" >
                    </td>
                    <td>
                        <input type="text" name="obligation_q_2[]" class="textfield" value="<?= $value->obligation_q_2 ?>" >
                    </td>
                    <td>
                        <input type="text" name="obligation_q_3[]" class="textfield" value="<?= $value->obligation_q_3 ?>" >
                    </td>
                    <td>
                        <input type="text" name="obligation_q_4[]" class="textfield" value="<?= $value->obligation_q_4 ?>" >
                    </td>
                    <td>
                        <input type="text" name="total_obligation[]" class="textfield" value="<?= $value->total_obligation ?>" >
                    </td> -->
                    <td>
                        <?= $form->field($model, 'disbursement_q_1[]', ['options' => ['tag' => false]])->textInput(['value' => $value->getDisbursement1($value->fiscal_year, $value->fund_cluster, $value->uacs_code, $value->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                    </td>
                    <td>
                        <?= $form->field($model, 'disbursement_q_2[]', ['options' => ['tag' => false]])->textInput(['value' => $value->getDisbursement2($value->fiscal_year, $value->fund_cluster, $value->uacs_code, $value->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                    </td>
                    <td>
                        <?= $form->field($model, 'disbursement_q_3[]', ['options' => ['tag' => false]])->textInput(['value' => $value->getDisbursement3($value->fiscal_year, $value->fund_cluster, $value->uacs_code, $value->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                    </td>
                    <td>
                        <?= $form->field($model, 'disbursement_q_4[]', ['options' => ['tag' => false]])->textInput(['value' => $value->getDisbursement4($value->fiscal_year, $value->fund_cluster, $value->uacs_code, $value->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                    </td>
                    <td>
                        <?= $form->field($model, 'total_disbursement[]', ['options' => ['tag' => false]])->textInput(['value' => $value->getDisbursementtotal($value->fiscal_year, $value->fund_cluster, $value->uacs_code, $value->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                    </td>
                </tr>
                <?php $far2 = Far101::find()->where(['parent_uacs' => $value->uacs_code])->all(); ?>
                    <?php foreach ($far2 as $value2) : ?>
                    <tr>
                        <td style="text-indent: 5px;">
                           <?= $form->field($model, 'id[]', ['options' => ['tag' => false]])->hiddenInput(['value' => $value2->id, 'class' => 'textfield'])->label(false) ?>
                            
                           <?= $form->field($model, 'particulars[]', ['options' => ['tag' => false]])->textInput(['value' => $value2->particulars, 'class' => 'textfield'])->label(false) ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'uacs_code[]', ['options' => ['tag' => false]])->textInput(['value' => $value2->uacs_code, 'class' => 'textfield'])->label(false) ?>
                        </td>
                        <!-- <td>
                            <input type="text" name="obligation_q_1[]" class="textfield" value="<?= $value->obligation_q_1 ?>" >
                        </td>
                        <td>
                            <input type="text" name="obligation_q_2[]" class="textfield" value="<?= $value->obligation_q_2 ?>" >
                        </td>
                        <td>
                            <input type="text" name="obligation_q_3[]" class="textfield" value="<?= $value->obligation_q_3 ?>" >
                        </td>
                        <td>
                            <input type="text" name="obligation_q_4[]" class="textfield" value="<?= $value->obligation_q_4 ?>" >
                        </td>
                        <td>
                            <input type="text" name="total_obligation[]" class="textfield" value="<?= $value->total_obligation ?>" >
                        </td> -->
                        <td>
                            <?= $form->field($model, 'disbursement_q_1[]', ['options' => ['tag' => false]])->textInput(['value' => $value2->getDisbursement1($value2->fiscal_year, $value2->fund_cluster, $value2->uacs_code, $value2->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'disbursement_q_2[]', ['options' => ['tag' => false]])->textInput(['value' => $value2->getDisbursement2($value2->fiscal_year, $value2->fund_cluster, $value2->uacs_code, $value2->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'disbursement_q_3[]', ['options' => ['tag' => false]])->textInput(['value' => $value2->getDisbursement3($value2->fiscal_year, $value2->fund_cluster, $value2->uacs_code, $value2->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'disbursement_q_4[]', ['options' => ['tag' => false]])->textInput(['value' => $value2->getDisbursement4($value2->fiscal_year, $value2->fund_cluster, $value2->uacs_code, $value2->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'total_disbursement[]', ['options' => ['tag' => false]])->textInput(['value' => $value2->getDisbursementtotal($value2->fiscal_year, $value2->fund_cluster, $value2->uacs_code, $value2->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                        </td>
                    </tr>
                        <?php $far3 = Far101::find()->where(['parent_uacs' => $value2->uacs_code])->all(); ?>
                        <?php foreach ($far3 as $value3) : ?>
                        <tr>
                            <td style="text-indent: 10px;">
                               <?= $form->field($model, 'id[]', ['options' => ['tag' => false]])->hiddenInput(['value' => $value3->id, 'class' => 'textfield'])->label(false) ?>
                                
                               <?= $form->field($model, 'particulars[]', ['options' => ['tag' => false]])->textInput(['value' => $value3->particulars, 'class' => 'textfield'])->label(false) ?>
                            </td>
                            <td>
                                <?= $form->field($model, 'uacs_code[]', ['options' => ['tag' => false]])->textInput(['value' => $value3->uacs_code, 'class' => 'textfield'])->label(false) ?>
                            </td>
                            <!-- <td>
                                <input type="text" name="obligation_q_1[]" class="textfield" value="<?= $value->obligation_q_1 ?>" >
                            </td>
                            <td>
                                <input type="text" name="obligation_q_2[]" class="textfield" value="<?= $value->obligation_q_2 ?>" >
                            </td>
                            <td>
                                <input type="text" name="obligation_q_3[]" class="textfield" value="<?= $value->obligation_q_3 ?>" >
                            </td>
                            <td>
                                <input type="text" name="obligation_q_4[]" class="textfield" value="<?= $value->obligation_q_4 ?>" >
                            </td>
                            <td>
                                <input type="text" name="total_obligation[]" class="textfield" value="<?= $value->total_obligation ?>" >
                            </td> -->
                            <td>
                                <?= $form->field($model, 'disbursement_q_1[]', ['options' => ['tag' => false]])->textInput(['value' => $value3->getDisbursement1($value3->fiscal_year, $value3->fund_cluster, $value3->uacs_code, $value3->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                            </td>
                            <td>
                                <?= $form->field($model, 'disbursement_q_2[]', ['options' => ['tag' => false]])->textInput(['value' => $value3->getDisbursement2($value3->fiscal_year, $value3->fund_cluster, $value3->uacs_code, $value3->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                            </td>
                            <td>
                                <?= $form->field($model, 'disbursement_q_3[]', ['options' => ['tag' => false]])->textInput(['value' => $value3->getDisbursement3($value3->fiscal_year, $value3->fund_cluster, $value3->uacs_code, $value3->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                            </td>
                            <td>
                                <?= $form->field($model, 'disbursement_q_4[]', ['options' => ['tag' => false]])->textInput(['value' => $value3->getDisbursement4($value3->fiscal_year, $value3->fund_cluster, $value3->uacs_code, $value3->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                            </td>
                            <td>
                                <?= $form->field($model, 'total_disbursement[]', ['options' => ['tag' => false]])->textInput(['value' => $value3->getDisbursementtotal($value3->fiscal_year, $value3->fund_cluster, $value3->uacs_code, $value3->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                            </td>
                        </tr>
                            <?php $far4 = Far101::find()->where(['parent_uacs' => $value3->uacs_code])->all(); ?>
                            <?php foreach ($far4 as $value4) : ?>
                            <tr>
                                <td style="text-indent: 15px;">
                                   <?= $form->field($model, 'id[]', ['options' => ['tag' => false]])->hiddenInput(['value' => $value4->id, 'class' => 'textfield'])->label(false) ?>
                                    
                                   <?= $form->field($model, 'particulars[]', ['options' => ['tag' => false]])->textInput(['value' => $value4->particulars, 'class' => 'textfield'])->label(false) ?>
                                </td>
                                <td>
                                    <?= $form->field($model, 'uacs_code[]', ['options' => ['tag' => false]])->textInput(['value' => $value4->uacs_code, 'class' => 'textfield'])->label(false) ?>
                                </td>
                                <!-- <td>
                                    <input type="text" name="obligation_q_1[]" class="textfield" value="<?= $value->obligation_q_1 ?>" >
                                </td>
                                <td>
                                    <input type="text" name="obligation_q_2[]" class="textfield" value="<?= $value->obligation_q_2 ?>" >
                                </td>
                                <td>
                                    <input type="text" name="obligation_q_3[]" class="textfield" value="<?= $value->obligation_q_3 ?>" >
                                </td>
                                <td>
                                    <input type="text" name="obligation_q_4[]" class="textfield" value="<?= $value->obligation_q_4 ?>" >
                                </td>
                                <td>
                                    <input type="text" name="total_obligation[]" class="textfield" value="<?= $value->total_obligation ?>" >
                                </td> -->
                                <td>
                                    <?= $form->field($model, 'disbursement_q_1[]', ['options' => ['tag' => false]])->textInput(['value' => $value4->getDisbursement1($value4->fiscal_year, $value4->fund_cluster, $value4->uacs_code, $value4->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                                </td>
                                <td>
                                    <?= $form->field($model, 'disbursement_q_2[]', ['options' => ['tag' => false]])->textInput(['value' => $value4->getDisbursement2($value4->fiscal_year, $value4->fund_cluster, $value4->uacs_code, $value4->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                                </td>
                                <td>
                                    <?= $form->field($model, 'disbursement_q_3[]', ['options' => ['tag' => false]])->textInput(['value' => $value4->getDisbursement3($value4->fiscal_year, $value4->fund_cluster, $value4->uacs_code, $value4->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                                </td>
                                <td>
                                    <?= $form->field($model, 'disbursement_q_4[]', ['options' => ['tag' => false]])->textInput(['value' => $value4->getDisbursement4($value4->fiscal_year, $value4->fund_cluster, $value4->uacs_code, $value4->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                                </td>
                                <td>
                                    <?= $form->field($model, 'total_disbursement[]', ['options' => ['tag' => false]])->textInput(['value' => $value4->getDisbursementtotal($value4->fiscal_year, $value4->fund_cluster, $value4->uacs_code, $value4->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                                </td>
                            </tr>
                                <?php $far5 = Far101::find()->where(['parent_uacs' => $value4->uacs_code])->all(); ?>
                                <?php foreach ($far5 as $value5) : ?>
                                <tr>
                                    <td style="text-indent: 20px;">
                                       <?= $form->field($model, 'id[]', ['options' => ['tag' => false]])->hiddenInput(['value' => $value5->id, 'class' => 'textfield'])->label(false) ?>
                                        
                                       <?= $form->field($model, 'particulars[]', ['options' => ['tag' => false]])->textInput(['value' => $value5->particulars, 'class' => 'textfield'])->label(false) ?>
                                    </td>
                                    <td>
                                        <?= $form->field($model, 'uacs_code[]', ['options' => ['tag' => false]])->textInput(['value' => $value5->uacs_code, 'class' => 'textfield'])->label(false) ?>
                                    </td>
                                    <!-- <td>
                                        <input type="text" name="obligation_q_1[]" class="textfield" value="<?= $value->obligation_q_1 ?>" >
                                    </td>
                                    <td>
                                        <input type="text" name="obligation_q_2[]" class="textfield" value="<?= $value->obligation_q_2 ?>" >
                                    </td>
                                    <td>
                                        <input type="text" name="obligation_q_3[]" class="textfield" value="<?= $value->obligation_q_3 ?>" >
                                    </td>
                                    <td>
                                        <input type="text" name="obligation_q_4[]" class="textfield" value="<?= $value->obligation_q_4 ?>" >
                                    </td>
                                    <td>
                                        <input type="text" name="total_obligation[]" class="textfield" value="<?= $value->total_obligation ?>" >
                                    </td> -->
                                    <td>
                                        <?= $form->field($model, 'disbursement_q_1[]', ['options' => ['tag' => false]])->textInput(['value' => $value5->getDisbursement1($value5->fiscal_year, $value5->fund_cluster, $value5->uacs_code, $value5->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                                    </td>
                                    <td>
                                        <?= $form->field($model, 'disbursement_q_2[]', ['options' => ['tag' => false]])->textInput(['value' => $value5->getDisbursement2($value5->fiscal_year, $value5->fund_cluster, $value5->uacs_code, $value5->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                                    </td>
                                    <td>
                                        <?= $form->field($model, 'disbursement_q_3[]', ['options' => ['tag' => false]])->textInput(['value' => $value5->getDisbursement3($value5->fiscal_year, $value5->fund_cluster, $value5->uacs_code, $value5->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                                    </td>
                                    <td>
                                        <?= $form->field($model, 'disbursement_q_4[]', ['options' => ['tag' => false]])->textInput(['value' => $value5->getDisbursement4($value5->fiscal_year, $value5->fund_cluster, $value5->uacs_code, $value5->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                                    </td>
                                    <td>
                                        <?= $form->field($model, 'total_disbursement[]', ['options' => ['tag' => false]])->textInput(['value' => $value5->getDisbursementtotal($value5->fiscal_year, $value5->fund_cluster, $value5->uacs_code, $value5->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                                    </td>
                                </tr>
                                    <?php $far6 = Far101::find()->where(['parent_uacs' => $value5->uacs_code])->all(); ?>
                                    <?php foreach ($far6 as $value6) : ?>
                                    <tr>
                                        <td style="text-indent: 25px;">
                                           <?= $form->field($model, 'id[]', ['options' => ['tag' => false]])->hiddenInput(['value' => $value6->id, 'class' => 'textfield'])->label(false) ?>
                                            
                                           <?= $form->field($model, 'particulars[]', ['options' => ['tag' => false]])->textInput(['value' => $value6->particulars, 'class' => 'textfield'])->label(false) ?>
                                        </td>
                                        <td>
                                            <?= $form->field($model, 'uacs_code[]', ['options' => ['tag' => false]])->textInput(['value' => $value6->uacs_code, 'class' => 'textfield'])->label(false) ?>
                                        </td>
                                        <!-- <td>
                                            <input type="text" name="obligation_q_1[]" class="textfield" value="<?= $value->obligation_q_1 ?>" >
                                        </td>
                                        <td>
                                            <input type="text" name="obligation_q_2[]" class="textfield" value="<?= $value->obligation_q_2 ?>" >
                                        </td>
                                        <td>
                                            <input type="text" name="obligation_q_3[]" class="textfield" value="<?= $value->obligation_q_3 ?>" >
                                        </td>
                                        <td>
                                            <input type="text" name="obligation_q_4[]" class="textfield" value="<?= $value->obligation_q_4 ?>" >
                                        </td>
                                        <td>
                                            <input type="text" name="total_obligation[]" class="textfield" value="<?= $value->total_obligation ?>" >
                                        </td> -->
                                        <td>
                                            <?= $form->field($model, 'disbursement_q_1[]', ['options' => ['tag' => false]])->textInput(['value' => $value6->getDisbursement1($value6->fiscal_year, $value6->fund_cluster, $value6->uacs_code, $value6->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                                        </td>
                                        <td>
                                            <?= $form->field($model, 'disbursement_q_2[]', ['options' => ['tag' => false]])->textInput(['value' => $value6->getDisbursement2($value6->fiscal_year, $value6->fund_cluster, $value6->uacs_code, $value6->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                                        </td>
                                        <td>
                                            <?= $form->field($model, 'disbursement_q_3[]', ['options' => ['tag' => false]])->textInput(['value' => $value6->getDisbursement3($value6->fiscal_year, $value6->fund_cluster, $value6->uacs_code, $value6->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                                        </td>
                                        <td>
                                            <?= $form->field($model, 'disbursement_q_4[]', ['options' => ['tag' => false]])->textInput(['value' => $value6->getDisbursement4($value6->fiscal_year, $value6->fund_cluster, $value6->uacs_code, $value6->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                                        </td>
                                        <td>
                                            <?= $form->field($model, 'total_disbursement[]', ['options' => ['tag' => false]])->textInput(['value' => $value6->getDisbursementtotal($value6->fiscal_year, $value6->fund_cluster, $value6->uacs_code, $value6->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                                        </td>
                                    </tr>
                                        <?php $far7 = Far101::find()->where(['parent_uacs' => $value6->uacs_code])->all(); ?>
                                        <?php foreach ($far7 as $value7) : ?>
                                        <tr>
                                            <td style="text-indent: 30px;">
                                               <?= $form->field($model, 'id[]', ['options' => ['tag' => false]])->hiddenInput(['value' => $value7->id, 'class' => 'textfield'])->label(false) ?>
                                                
                                               <?= $form->field($model, 'particulars[]', ['options' => ['tag' => false]])->textInput(['value' => $value7->particulars, 'class' => 'textfield'])->label(false) ?>
                                            </td>
                                            <td>
                                                <?= $form->field($model, 'uacs_code[]', ['options' => ['tag' => false]])->textInput(['value' => $value7->uacs_code, 'class' => 'textfield'])->label(false) ?>
                                            </td>
                                            <!-- <td>
                                                <input type="text" name="obligation_q_1[]" class="textfield" value="<?= $value->obligation_q_1 ?>" >
                                            </td>
                                            <td>
                                                <input type="text" name="obligation_q_2[]" class="textfield" value="<?= $value->obligation_q_2 ?>" >
                                            </td>
                                            <td>
                                                <input type="text" name="obligation_q_3[]" class="textfield" value="<?= $value->obligation_q_3 ?>" >
                                            </td>
                                            <td>
                                                <input type="text" name="obligation_q_4[]" class="textfield" value="<?= $value->obligation_q_4 ?>" >
                                            </td>
                                            <td>
                                                <input type="text" name="total_obligation[]" class="textfield" value="<?= $value->total_obligation ?>" >
                                            </td> -->
                                            <td>
                                                <?= $form->field($model, 'disbursement_q_1[]', ['options' => ['tag' => false]])->textInput(['value' => $value7->getDisbursement1($value7->fiscal_year, $value7->fund_cluster, $value7->uacs_code, $value7->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                                            </td>
                                            <td>
                                                <?= $form->field($model, 'disbursement_q_2[]', ['options' => ['tag' => false]])->textInput(['value' => $value7->getDisbursement2($value7->fiscal_year, $value7->fund_cluster, $value7->uacs_code, $value7->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                                            </td>
                                            <td>
                                                <?= $form->field($model, 'disbursement_q_3[]', ['options' => ['tag' => false]])->textInput(['value' => $value7->getDisbursement3($value7->fiscal_year, $value7->fund_cluster, $value7->uacs_code, $value7->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                                            </td>
                                            <td>
                                                <?= $form->field($model, 'disbursement_q_4[]', ['options' => ['tag' => false]])->textInput(['value' => $value7->getDisbursement4($value7->fiscal_year, $value7->fund_cluster, $value7->uacs_code, $value7->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                                            </td>
                                            <td>
                                                <?= $form->field($model, 'total_disbursement[]', ['options' => ['tag' => false]])->textInput(['value' => $value7->getDisbursementtotal($value7->fiscal_year, $value7->fund_cluster, $value7->uacs_code, $value7->parent_uacs), 'class' => 'textfield'])->label(false) ?>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    <?php endforeach ?>
                                <?php endforeach ?>
                            <?php endforeach ?>
                        <?php endforeach ?>
                    <?php endforeach ?>
                <?php endforeach ?>
            </table>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
</div>
