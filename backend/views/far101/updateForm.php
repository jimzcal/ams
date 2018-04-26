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
                        STATEMENT OF CURRENT YEAR DISBURSEMENTS
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
                        <?= $form->field($model, 'fiscal_year')->dropDownList(['2017'=>'2017', '2018' => '2018', '2019' => '2019', '2020' => '2020'],['class' => 'myfield'])->label(false) ?></td>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td style="width: 160px; vertical-align: text-top;">Fund Cluster</td>
                    <td style="width: 30px; vertical-align: text-top;">:</td>
                    <td style="font-weight: bold;">
                        <?= $form->field($model, 'fund_cluster')->dropDownList(ArrayHelper::map(FundCluster::find()->all(),'fund_cluster','fund_cluster'), ['class' => 'myfield'])->label(false) ;
                        ?>
                    </td>
                    <td></td>
                </tr>
            </table>
            <br>
            <table class="table table-bordered table-condensed">
                <tr>
                    <th rowspan="2" style="width: 330px; text-align: center;">PARTICULARS</th>
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
                       <input type="hidden" name="id[]" class="myfield" value="<?= $value->id ?>" >
                       <input type="text" name="particulars[]" class="myfield" value="<?= $value->particulars ?>" > 
                    </td>
                    <td>
                        <input type="text" name="uacs_code[]" class="myfield" value="<?= $value->uacs_code ?>" >   
                    </td>
                    <!-- <td>
                        <input type="text" name="obligation_q_1[]" class="myfield" value="<?= $value->obligation_q_1 ?>" >
                    </td>
                    <td>
                        <input type="text" name="obligation_q_2[]" class="myfield" value="<?= $value->obligation_q_2 ?>" >
                    </td>
                    <td>
                        <input type="text" name="obligation_q_3[]" class="myfield" value="<?= $value->obligation_q_3 ?>" >
                    </td>
                    <td>
                        <input type="text" name="obligation_q_4[]" class="myfield" value="<?= $value->obligation_q_4 ?>" >
                    </td>
                    <td>
                        <input type="text" name="total_obligation[]" class="myfield" value="<?= $value->total_obligation ?>" >
                    </td> -->
                    <td>
                        <?php $a = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['mfo_pap'=>$value->uacs_code])
                                        ->andWhere(['ors_year'=>$model->fiscal_year])
                                        ->andWhere(['fund_cluster' => $model->fund_cluster])
                                        ->andWhere(['or', ['ors_month' => '01'], ['ors_month' => '02'], ['ors_month' => '03']])
                                        ->all(), 'net_amount'));
                        ?>
                        <input type="text" name="disbursement_q_1[]" class="myfield" value="<?= $a; ?>" >
                    </td>
                    <td>
                        <?php $a1 = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['mfo_pap'=>$value->uacs_code])
                                        ->andWhere(['ors_year'=>$model->fiscal_year])
                                        ->andWhere(['fund_cluster' => $model->fund_cluster])
                                        ->andWhere(['or', ['ors_month' => '04'], ['ors_month' => '05'], ['ors_month' => '06']])
                                        ->all(), 'net_amount')); 
                        ?>
                        <input type="text" name="disbursement_q_2[]" class="myfield" value="<?= $a1; ?>" >
                    </td>
                    <td>
                        <?php $a2 = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['mfo_pap'=>$value->uacs_code])
                                        ->andWhere(['ors_year'=>$model->fiscal_year])
                                        ->andWhere(['fund_cluster' => $model->fund_cluster])
                                        ->andWhere(['or', ['ors_month' => '07'], ['ors_month' => '08'], ['ors_month' => '09']])
                                        ->all(), 'net_amount'));
                        ?>
                        <input type="text" name="disbursement_q_3[]" class="myfield" value="<?= $a2; ?>" >
                    </td>
                    <td>
                        <?php $a3 = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['mfo_pap'=>$value->uacs_code])
                                        ->andWhere(['ors_year'=>$model->fiscal_year])
                                        ->andWhere(['fund_cluster' => $model->fund_cluster])
                                        ->andWhere(['or', ['ors_month' => '10'], ['ors_month' => '11'], ['ors_month' => '12']])
                                        ->all(), 'net_amount')); 
                        ?>
                        <input type="text" name="disbursement_q_4[]" class="myfield" value="<?= $a3; ?>" >
                    </td>
                    <td>
                        <?php $a_sum = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['mfo_pap'=>$value->uacs_code])
                                        ->andWhere(['ors_year'=>$model->fiscal_year])
                                        ->andWhere(['fund_cluster' => $model->fund_cluster])
                                        ->all(), 'net_amount'));
                        ?>
                        <input type="text" name="total_disbursement[]" class="myfield" value="<?= $a_sum; ?>" >
                    </td>
                </tr>
                    <?php $sub_far = Far101::find()->where(['parent_id' => $value->id])->all(); ?>
                    <?php foreach ($sub_far as $val) : ?>
                        <tr>
                            <td style="text-indent: 10px;">
                                <input type="hidden" name="idb[]" class="myfield" value="<?= $val->id ?>" >
                                <input type="text" name="particularsb[]" class="myfield" value="<?= $val->particulars ?>" > 
                            </td>
                            <td>
                                <input type="text" name="uacs_codeb[]" class="myfield" value="<?= $val->uacs_code ?>" > 
                            </td>
                            <!-- <td>
                                <input type="text" name="obligation_q_1b[]" class="myfield" value="<?= $val->obligation_q_1 ?>" > 
                            </td>
                            <td>
                                <input type="text" name="obligation_q_2b[]" class="myfield" value="<?= $val->obligation_q_2 ?>" >
                            </td>
                            <td>
                                <input type="text" name="obligation_q_3b[]" class="myfield" value="<?= $val->obligation_q_3 ?>" >
                            </td>
                            <td>
                                <input type="text" name="obligation_q_4b[]" class="myfield" value="<?= $val->obligation_q_4 ?>" >
                            </td>
                            <td>
                                <input type="text" name="total_obligationb[]" class="myfield" value="<?= $val->total_obligation ?>" >
                            </td> -->
                            <td>
                                <?php $b = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['mfo_pap'=>$val->uacs_code])
                                        ->andWhere(['ors_year'=>$model->fiscal_year])
                                        ->andWhere(['fund_cluster' => $model->fund_cluster])
                                        ->andWhere(['or', ['ors_month' => '01'], ['ors_month' => '02'], ['ors_month' => '03'],])
                                        ->all(), 'net_amount'));
                                ?>
                                <input type="text" name="disbursement_q_1b[]" class="myfield" value="<?= $b; ?>">
                            </td>
                            <td>
                                <?php $b1 = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['mfo_pap'=>$val->uacs_code])
                                        ->andWhere(['ors_year'=>$model->fiscal_year])
                                        ->andWhere(['fund_cluster' => $model->fund_cluster])
                                        ->andWhere(['or', ['ors_month' => '04'], ['ors_month' => '05'], ['ors_month' => '06'],])
                                        ->all(), 'net_amount')); 
                                ?>
                                <input type="text" name="disbursement_q_2b[]" class="myfield" value="<?= $b1; ?>" >
                            </td>
                            <td>
                                <?php $b2 = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['mfo_pap'=>$val->uacs_code])
                                        ->andWhere(['ors_year'=>$model->fiscal_year])
                                        ->andWhere(['fund_cluster' => $model->fund_cluster])
                                        ->andWhere(['or', ['ors_month' => '07'], ['ors_month' => '08'], ['ors_month' => '09'],])
                                        ->all(), 'net_amount'));
                                ?>
                                <input type="text" name="disbursement_q_3b[]" class="myfield" value="<?= $b2; ?>" >
                            </td>
                            <td>
                                <?php $b3 = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['mfo_pap'=>$val->uacs_code])
                                        ->andWhere(['ors_year'=>$model->fiscal_year])
                                        ->andWhere(['fund_cluster' => $model->fund_cluster])
                                        ->andWhere(['or', ['ors_month' => '10'], ['ors_month' => '11'], ['ors_month' => '12'],])
                                        ->all(), 'net_amount'));
                                ?>
                                <input type="text" name="disbursement_q_4b[]" class="myfield" value="<?= $b3; ?>" >
                            </td>
                            <td>
                                <?php $b_sum = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['mfo_pap'=>$val->uacs_code])
                                        ->andWhere(['ors_year'=>$model->fiscal_year])
                                        ->andWhere(['fund_cluster' => $model->fund_cluster])
                                        ->all(), 'net_amount'));
                                ?>
                                <input type="text" name="total_disbursementb[]" class="myfield" value="<?= $b_sum; ?>" >
                            </td>
                        </tr>
                            <?php $sub_far2 = Far101::find()->where(['parent_id' => $val->id])->all(); ?>
                            <?php foreach ($sub_far2 as $data) : ?>
                                <tr>
                                    <td style="text-indent: 20px;">
                                        <input type="hidden" name="idc[]" class="myfield" value="<?= $data->id ?>" >
                                        <input type="text" name="particularsc[]" class="myfield" value="<?= $data->particulars ?>" >
                                    </td>
                                    <td>
                                        <input type="text" name="uacs_codec[]" class="myfield" value="<?= $data->uacs_code ?>" >
                                    </td>
                                    <!-- <td>
                                        <input type="text" name="obligation_q_1c[]" class="myfield" value="<?= $data->obligation_q_1 ?>" >
                                    </td>
                                    <td>
                                        <input type="text" name="obligation_q_2c[]" class="myfield" value="<?= $data->obligation_q_2 ?>" >
                                    </td>
                                    <td>
                                        <input type="text" name="obligation_q_3c[]" class="myfield" value="<?= $data->obligation_q_3 ?>" >
                                    </td>
                                    <td>
                                        <input type="text" name="obligation_q_4c[]" class="myfield" value="<?= $data->obligation_q_4 ?>" >
                                    </td>
                                    <td>
                                        <input type="text" name="total_obligationc[]" class="myfield" value="<?= $data->total_obligation ?>" >
                                    </td> -->
                                    <td>
                                        <?php $c = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                                ->where(['mfo_pap'=>$data->uacs_code])
                                                ->andWhere(['ors_year'=>$model->fiscal_year])
                                                ->andWhere(['fund_cluster' => $model->fund_cluster])
                                                ->andWhere(['or', ['ors_month' => '01'], ['ors_month' => '02'], ['ors_month' => '03'],])
                                                ->all(), 'net_amount'));
                                        ?>
                                        <input type="text" name="disbursement_q_1c[]" class="myfield" value="<?= $c; ?>" >
                                    </td>
                                    <td>
                                        <?php $c1 = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                                ->where(['mfo_pap'=>$data->uacs_code])
                                                ->andWhere(['ors_year'=>$model->fiscal_year])
                                                ->andWhere(['fund_cluster' => $model->fund_cluster])
                                                ->andWhere(['or', ['ors_month' => '04'], ['ors_month' => '05'], ['ors_month' => '06'],])
                                                ->all(), 'net_amount'));
                                        ?>
                                        <input type="text" name="disbursement_q_2c[]" class="myfield" value="<?= $c1; ?>" >
                                    </td>
                                    <td>
                                        <?php $c2 = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                                ->where(['mfo_pap'=>$data->uacs_code])
                                                ->andWhere(['ors_year'=>$model->fiscal_year])
                                                ->andWhere(['fund_cluster' => $model->fund_cluster])
                                                ->andWhere(['or', ['ors_month' => '07'], ['ors_month' => '08'], ['ors_month' => '09'],])
                                                ->all(), 'net_amount'));
                                        ?>
                                        <input type="text" name="disbursement_q_3c[]" class="myfield" value="<?= $c2; ?>" >
                                    </td>
                                    <td>
                                        <?php $c3 = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                                ->where(['mfo_pap'=>$data->uacs_code])
                                                ->andWhere(['ors_year'=>$model->fiscal_year])
                                                ->andWhere(['fund_cluster' => $model->fund_cluster])
                                                ->andWhere(['or', ['ors_month' => '10'], ['ors_month' => '11'], ['ors_month' => '12'],])
                                                ->all(), 'net_amount'));
                                        ?>
                                        <input type="text" name="disbursement_q_4c[]" class="myfield" value="<?= $c3; ?>" >
                                    </td>
                                    <td>
                                        <?php $c_sum = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                                ->where(['mfo_pap'=>$data->uacs_code])
                                                ->andWhere(['ors_year'=>$model->fiscal_year])
                                                ->andWhere(['fund_cluster' => $model->fund_cluster])
                                                ->all(), 'net_amount'));
                                        ?>
                                        <input type="text" name="total_disbursementc[]" class="myfield" value="<?= $c_sum; ?>" >
                                    </td>
                                </tr>
                                    <?php $sub_far3 = Far101::find()->where(['parent_id' => $data->id])->all(); ?>
                                    <?php foreach ($sub_far3 as $data4) : ?>
                                        <tr>
                                            <td style="text-indent: 30px;">
                                                <input type="hidden" name="idd[]" class="myfield" value="<?= $data4->id ?>" >
                                                <input type="text" name="particularsd[]" class="myfield" value="<?= $data4->particulars ?>" >
                                            </td>
                                            <td>
                                                <input type="text" name="uacs_coded[]" class="myfield" value="<?= $data4->uacs_code ?>" >
                                            </td>
                                            <!-- <td>
                                                <input type="text" name="obligation_q_1d[]" class="myfield" value="<?= $data4->obligation_q_1 ?>" >
                                            </td>
                                            <td>
                                                <input type="text" name="obligation_q_2d[]" class="myfield" value="<?= $data4->obligation_q_2 ?>" >
                                            </td>
                                            <td>
                                                <input type="text" name="obligation_q_3d[]" class="myfield" value="<?= $data4->obligation_q_3 ?>" >
                                            </td>
                                            <td>
                                                <input type="text" name="obligation_q_4d[]" class="myfield" value="<?= $data4->obligation_q_4 ?>" >
                                            </td>
                                            <td>
                                                <input type="text" name="total_obligationd[]" class="myfield" value="<?= $data4->total_obligation ?>" >
                                            </td> -->
                                            <td>
                                                <?php $d = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                                        ->where(['mfo_pap'=>$data4->uacs_code])
                                                        ->andWhere(['ors_year'=>$model->fiscal_year])
                                                        ->andWhere(['fund_cluster' => $model->fund_cluster])
                                                        ->andWhere(['or', ['ors_month' => '01'], ['ors_month' => '02'], ['ors_month' => '03'],])
                                                        ->all(), 'net_amount'));
                                                ?>
                                                <input type="text" name="disbursement_q_1d[]" class="myfield" value="<?= $d; ?>" >
                                            </td>
                                            <td>
                                                <?php $d1 = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                                        ->where(['mfo_pap'=>$data4->uacs_code])
                                                        ->andWhere(['ors_year'=>$model->fiscal_year])
                                                        ->andWhere(['fund_cluster' => $model->fund_cluster])
                                                        ->andWhere(['or', ['ors_month' => '04'], ['ors_month' => '05'], ['ors_month' => '06'],])
                                                        ->all(), 'net_amount'));
                                                ?>
                                                <input type="text" name="disbursement_q_2d[]" class="myfield" value="<?= $d1; ?>" >
                                            </td>
                                            <td>
                                                <?php $d2 = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                                        ->where(['mfo_pap'=>$data4->uacs_code])
                                                        ->andWhere(['ors_year'=>$model->fiscal_year])
                                                        ->andWhere(['fund_cluster' => $model->fund_cluster])
                                                        ->andWhere(['or', ['ors_month' => '07'], ['ors_month' => '08'], ['ors_month' => '09'],])
                                                        ->all(), 'net_amount'));
                                                ?>
                                                <input type="text" name="disbursement_q_3d[]" class="myfield" value="<?= $d2; ?>" >
                                            </td>
                                            <td>
                                                <?php $d3 = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                                        ->where(['mfo_pap'=>$data4->uacs_code])
                                                        ->andWhere(['ors_year'=>$model->fiscal_year])
                                                        ->andWhere(['fund_cluster' => $model->fund_cluster])
                                                        ->andWhere(['or', ['ors_month' => '10'], ['ors_month' => '11'], ['ors_month' => '12'],])
                                                        ->all(), 'net_amount'));
                                                ?>
                                                <input type="text" name="disbursement_q_4d[]" class="myfield" value="<?= $d3; ?>" >
                                            </td>
                                            <td>
                                                <?php $d_sum = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                                        ->where(['mfo_pap'=>$data4->uacs_code])
                                                        ->andWhere(['ors_year'=>$model->fiscal_year])
                                                        ->andWhere(['fund_cluster' => $model->fund_cluster])
                                                        ->all(), 'net_amount'));
                                                ?>
                                                <input type="text" name="total_disbursementd[]" class="myfield" value="<?= $d_sum; ?>" >
                                            </td>
                                        </tr>
                                            <?php $sub_far4 = Far101::find()->where(['parent_id' => $data4->id])->all(); ?>
                                            <?php foreach ($sub_far4 as $data5) : ?>
                                                <tr>
                                                    <td style="text-indent: 40px;">
                                                        <input type="hidden" name="ide[]" class="myfield" value="<?= $data5->id ?>" >
                                                        <input type="text" name="particularse[]" class="myfield" value="<?= $data5->particulars ?>" >
                                                    </td>
                                                    <td>
                                                        <input type="text" name="uacs_codee[]" class="myfield" value="<?= $data5->uacs_code ?>" >
                                                    </td>
                                                    <!-- <td>
                                                        <input type="text" name="obligation_q_1e[]" class="myfield" value="<?= $data5->obligation_q_1 ?>" >
                                                    </td>
                                                    <td>
                                                         <input type="text" name="obligation_q_2e[]" class="myfield" value="<?= $data5->obligation_q_2 ?>" >
                                                    </td>
                                                    <td>
                                                        <input type="text" name="obligation_q_3e[]" class="myfield" value="<?= $data5->obligation_q_3 ?>" >
                                                    </td>
                                                    <td>
                                                        <input type="text" name="obligation_q_4e[]" class="myfield" value="<?= $data5->obligation_q_4 ?>" >
                                                    </td>
                                                    <td>
                                                        <input type="text" name="total_obligatione[]" class="myfield" value="<?= $data5->total_obligation ?>" >
                                                    </td> -->
                                                    <td>
                                                        <?php $e = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                                                ->where(['mfo_pap'=>$data5->uacs_code])
                                                                ->andWhere(['ors_year'=>$model->fiscal_year])
                                                                ->andWhere(['fund_cluster' => $model->fund_cluster])
                                                                ->andWhere(['or', ['ors_month' => '01'], ['ors_month' => '02'], ['ors_month' => '03'],])
                                                                ->all(), 'net_amount'));
                                                        ?>
                                                        <input type="text" name="disbursement_q_1e[]" class="myfield" value="<?= $e; ?>" >
                                                    </td>
                                                    <td>
                                                        <?php $e1 = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                                                ->where(['mfo_pap'=>$data5->uacs_code])
                                                                ->andWhere(['ors_year'=>$model->fiscal_year])
                                                                ->andWhere(['fund_cluster' => $model->fund_cluster])
                                                                ->andWhere(['or', ['ors_month' => '04'], ['ors_month' => '05'], ['ors_month' => '06'],])
                                                                ->all(), 'net_amount'));
                                                        ?>
                                                        <input type="text" name="disbursement_q_2e[]" class="myfield" value="<?= $e1; ?>" >
                                                    </td>
                                                    <td>
                                                        <?php $e2 = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                                                ->where(['mfo_pap'=>$data5->uacs_code])
                                                                ->andWhere(['ors_year'=>$model->fiscal_year])
                                                                ->andWhere(['fund_cluster' => $model->fund_cluster])
                                                                ->andWhere(['or', ['ors_month' => '07'], ['ors_month' => '08'], ['ors_month' => '09'],])
                                                                ->all(), 'net_amount'));
                                                        ?>
                                                        <input type="text" name="disbursement_q_3e[]" class="myfield" value="<?= $e2; ?>" >
                                                    </td>
                                                    <td>
                                                        <?php $e3 = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                                                ->where(['mfo_pap'=>$data5->uacs_code])
                                                                ->andWhere(['ors_year'=>$model->fiscal_year])
                                                                ->andWhere(['fund_cluster' => $model->fund_cluster])
                                                                ->andWhere(['or', ['ors_month' => '10'], ['ors_month' => '11'], ['ors_month' => '12'],])
                                                                ->all(), 'net_amount'));
                                                        ?>
                                                        <input type="text" name="disbursement_q_4e[]" class="myfield" value="<?= $e3; ?>" >
                                                    </td>
                                                    <td>
                                                        <?php $e_sum = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                                                ->where(['mfo_pap'=>$data5->uacs_code])
                                                                ->andWhere(['ors_year'=>$model->fiscal_year])
                                                                ->andWhere(['fund_cluster' => $model->fund_cluster])
                                                                ->all(), 'net_amount'));
                                                        ?>
                                                        <input type="text" name="total_disbursemente[]" class="myfield" value="<?= $e_sum; ?>" 
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                    <?php endforeach ?>
                            <?php endforeach ?>
                    <?php endforeach ?>
            <?php endforeach ?>
            </table>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
</div>
