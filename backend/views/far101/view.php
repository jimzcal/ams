<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Far101;
use yii\helpers\ArrayHelper;
use backend\models\OrsRegistry;

/* @var $this yii\web\View */
/* @var $model backend\models\Far101 */

$this->title = 'FAR 1 - '.$model->fund_cluster;
// $this->params['breadcrumbs'][] = ['label' => 'Far101s', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="far101-view">

    <div class="btn-group btn-group-vertical" style="float: left; left: 0; z-index: 300; position: fixed;" id="noprint">
        <?= Html::a('<i class="glyphicon glyphicon-arrow-left"></i>', ["/far101/index"], ['class' => 'btn btn-default']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-print" style= "font-size: 14px;"></i>', ['print', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-pencil" style= "font-size: 14px;"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-trash" style= "font-size: 14px;"></i>', ['delete', 'id' => $model->id], ['class' => 'btn btn-default',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?> 
    </div>

    <div style="margin-left: auto; margin-right: auto; width: auto;">
        <div class="view-form">
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
                        <td style="width: 160px;">Fiscal Year</td>
                        <td style="width: 30px;">:</td>
                        <td style="font-weight: bold;">
                            <?= $model->fiscal_year ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="width: 160px;">Fund Cluster</td>
                        <td style="width: 30px;">:</td>
                        <td style="font-weight: bold;">
                            <?= $model->fund_cluster ?>
                        </td>
                        <td></td>
                    </tr>
            </table>
                <br>
            <table class="table table-bordered table-condensed">
                <tr>
                    <th rowspan="2" style="width: 280px; text-align: center;">PARTICULARS</th>
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
                    <td><?= $value->particulars ?></td>
                    <td><?= $value->uacs_code ?></td>
                    <!-- <td><?= $value->obligation_q_1 ?></td>
                    <td><?= $value->obligation_q_2 ?></td>
                    <td><?= $value->obligation_q_3 ?></td>
                    <td><?= $value->obligation_q_4 ?></td>
                    <td><?= $value->total_obligation ?></td> -->
                    <td style="text-align: right;">
                        <?= number_format($value->disbursement_q_1, 2) == 0.00 ? '-' : number_format($value->disbursement_q_1, 2) ?>
                    </td>
                    <td style="text-align: right;">
                        <?= number_format($value->disbursement_q_2, 2) == 0.00 ? '-' : number_format($value->disbursement_q_2, 2) ?>
                    </td>
                    <td style="text-align: right;">
                        <?= number_format($value->disbursement_q_3, 2) == 0.00 ? '-' : number_format($value->disbursement_q_3, 2) ?>
                    </td>
                    <td style="text-align: right;">
                        <?= number_format($value->disbursement_q_4, 2) == 0.00 ? '-' : number_format($value->disbursement_q_4, 2) ?>
                    </td>
                    <td style="text-align: right;"><?= number_format($value->total_disbursement, 2) == 0.00 ? '-' : number_format($value->total_disbursement, 2) ?></td>
                </tr>
                    <?php $sub_far = Far101::find()->where(['parent_uacs' => $value->uacs_code])->all(); ?>
                    <?php foreach ($sub_far as $val) : ?>
                        <tr>
                            <td style="text-indent: 10px;"><?= $val->particulars ?></td>
                            <td><?= $val->uacs_code ?></td>
                            <!-- <td><?= $val->obligation_q_1 ?></td>
                            <td><?= $val->obligation_q_2 ?></td>
                            <td><?= $val->obligation_q_3 ?></td>
                            <td><?= $val->obligation_q_4 ?></td>
                            <td><?= $val->total_obligation ?></td> -->
                            <td style="text-align: right;">
                                <?= number_format($val->disbursement_q_1, 2) == 0.00 ? '-' : number_format($val->disbursement_q_1, 2) ?>
                            </td>
                            <td style="text-align: right;">
                                <?= number_format($val->disbursement_q_2, 2) == 0.00 ? '-' : number_format($val->disbursement_q_2, 2) ?>
                            </td>
                            <td style="text-align: right;">
                                <?= number_format($val->disbursement_q_3, 2) == 0.00 ? '-' : number_format($val->disbursement_q_3, 2) ?>
                            </td>
                            <td style="text-align: right;">
                                <?= number_format($val->disbursement_q_4, 2) == 0.00 ? '-' : number_format($val->disbursement_q_4, 2) ?>
                            </td>
                            <td style="text-align: right;">
                                <?= number_format($val->total_disbursement, 2) == 0.0 ? '-' : number_format($val->total_disbursement, 2) ?>
                            </td>
                        </tr>
                            <?php $sub_far2 = Far101::find()->where(['parent_uacs' => $val->uacs_code])->all(); ?>
                            <?php foreach ($sub_far2 as $data) : ?>
                                <tr>
                                    <td style="text-indent: 20px;"><?= $data->particulars ?></td>
                                    <td><?= $data->uacs_code ?></td>
                                    <!-- <td><?= $data->obligation_q_1 ?></td>
                                    <td><?= $data->obligation_q_2 ?></td>
                                    <td><?= $data->obligation_q_3 ?></td>
                                    <td><?= $data->obligation_q_4 ?></td>
                                    <td><?= $data->total_obligation ?></td> -->
                                    <td style="text-align: right;">
                                        <?= number_format($data->disbursement_q_1, 2) == 0.00 ? '-' : number_format($data->disbursement_q_1, 2) ?>
                                    </td>
                                    <td style="text-align: right;">
                                        <?= number_format($data->disbursement_q_2, 2) == 0.00 ? '-' : number_format($data->disbursement_q_2, 2) ?>
                                    </td>
                                    <td style="text-align: right;">
                                        <?= number_format($data->disbursement_q_3, 2) == 0.00 ? '-' : number_format($data->disbursement_q_3, 2) ?>
                                    </td>
                                    <td style="text-align: right;">
                                        <?= number_format($data->disbursement_q_4, 2) == 0.00 ? '-' : number_format($data->disbursement_q_4, 2) ?>
                                    </td>
                                    <td style="text-align: right;">
                                        <?= number_format($data->total_disbursement, 2) == 0.00 ? '-' : number_format($data->total_disbursement, 2) ?>
                                    </td>
                                </tr>
                                    <?php $sub_far3 = Far101::find()->where(['parent_uacs' => $data->uacs_code])->all(); ?>
                                    <?php foreach ($sub_far3 as $data4) : ?>
                                        <tr>
                                            <td style="text-indent: 30px;"><?= $data4->particulars ?></td>
                                            <td><?= $data4->uacs_code ?></td>
                                            <!-- <td><?= $data4->obligation_q_1 ?></td>
                                            <td><?= $data4->obligation_q_2 ?></td>
                                            <td><?= $data4->obligation_q_3 ?></td>
                                            <td><?= $data4->obligation_q_4 ?></td>
                                            <td><?= $data4->total_obligation ?></td> -->
                                            <td style="text-align: right;">
                                                <?= number_format($data4->disbursement_q_1, 2) == 0.00 ? '-' : number_format($data4->disbursement_q_1, 2) ?>
                                            </td>
                                            <td style="text-align: right;">
                                                <?= number_format($data4->disbursement_q_2, 2) == 0.00 ? '-' : number_format($data4->disbursement_q_2, 2) ?>
                                            </td>
                                            <td style="text-align: right;">
                                                <?= number_format($data4->disbursement_q_3, 2) == 0.00 ? '-' : number_format($data4->disbursement_q_3, 2) ?>
                                            </td>
                                            <td style="text-align: right;">
                                                <?= number_format($data4->disbursement_q_4, 2) == 0.00 ? '-' : number_format($data4->disbursement_q_4, 2) ?>
                                            </td>
                                            <td style="text-align: right;">
                                                <?= number_format($data4->total_disbursement, 2) == 0.00 ? '-' : number_format($data4->total_disbursement, 2) ?>
                                            </td>
                                        </tr>
                                            <?php $sub_far4 = Far101::find()->where(['parent_uacs' => $data4->uacs_code])->all(); ?>
                                            <?php foreach ($sub_far4 as $data5) : ?>
                                                <tr>
                                                    <td style="text-indent: 40px;"><?= $data5->particulars ?></td>
                                                    <td><?= $data5->uacs_code ?></td>
                                                    <!-- <td><?= $data5->obligation_q_1 ?></td>
                                                    <td><?= $data5->obligation_q_2 ?></td>
                                                    <td><?= $data5->obligation_q_3 ?></td>
                                                    <td><?= $data5->obligation_q_4 ?></td>
                                                    <td><?= $data5->total_obligation ?></td> -->
                                                    <td style="text-align: right;">
                                                        <?= number_format($data5->disbursement_q_1, 2) == 0.00 ? '-' : number_format($data5->disbursement_q_1, 2) ?>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        <?= number_format($data5->disbursement_q_2, 2) == 0.00 ? '-' : number_format($data5->disbursement_q_2, 2) ?>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        <?= number_format($data5->disbursement_q_3, 2) == 0.00 ? '-' : number_format($data5->disbursement_q_3, 2) ?>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        <?= number_format($data5->disbursement_q_4, 2) == 0.00 ? '-' : number_format($data5->disbursement_q_4, 2) ?>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        <?= number_format($data5->total_disbursement, 2) == 0.00 ? '-' : number_format($data5->total_disbursement, 2) ?>
                                                    </td>
                                                </tr>
                                                    <?php $sub_far5 = Far101::find()->where(['parent_uacs' => $data5->uacs_code])->all(); ?>
                                                    <?php foreach ($sub_far5 as $data6) : ?>
                                                        <tr>
                                                            <td style="text-indent: 45px;"><?= $data6->particulars ?></td>
                                                            <td><?= $data6->uacs_code ?></td>
                                                            <!-- <td><?= $data5->obligation_q_1 ?></td>
                                                            <td><?= $data5->obligation_q_2 ?></td>
                                                            <td><?= $data5->obligation_q_3 ?></td>
                                                            <td><?= $data5->obligation_q_4 ?></td>
                                                            <td><?= $data5->total_obligation ?></td> -->
                                                            <td style="text-align: right;">
                                                                <?= number_format($data6->disbursement_q_1, 2) == 0.00 ? '-' : number_format($data6->disbursement_q_1, 2) ?>
                                                            </td>
                                                            <td style="text-align: right;">
                                                                <?= number_format($data6->disbursement_q_2, 2) == 0.00 ? '-' : number_format($data6->disbursement_q_2, 2) ?>
                                                            </td>
                                                            <td style="text-align: right;">
                                                                <?= number_format($data6->disbursement_q_3, 2) == 0.00 ? '-' : number_format($data6->disbursement_q_3, 2) ?>
                                                            </td>
                                                            <td style="text-align: right;">
                                                                <?= number_format($data6->disbursement_q_4, 2) == 0.00 ? '-' : number_format($data6->disbursement_q_4, 2) ?>
                                                            </td>
                                                            <td style="text-align: right;">
                                                                <?= number_format($data6->total_disbursement, 2) == 0.00 ? '-' : number_format($data6->total_disbursement, 2) ?>
                                                            </td>
                                                        </tr>
                                                             <?php $sub_far6 = Far101::find()->where(['parent_uacs' => $data6->uacs_code])->all(); ?>
                                                            <?php foreach ($sub_far6 as $data7) : ?>
                                                                <tr>
                                                                    <td style="text-indent: 50px;">
                                                                        <?= $data7->particulars ?></td>
                                                                    <td><?= $data7->uacs_code ?></td>
                                                                    <!-- <td><?= $data5->obligation_q_1 ?></td>
                                                                    <td><?= $data5->obligation_q_2 ?></td>
                                                                    <td><?= $data5->obligation_q_3 ?></td>
                                                                    <td><?= $data5->obligation_q_4 ?></td>
                                                                    <td><?= $data5->total_obligation ?></td> -->
                                                                    <td style="text-align: right;">
                                                                        <?= number_format($data7->disbursement_q_1, 2) == 0.00 ? '-' : number_format($data7->disbursement_q_1, 2) ?>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                        <?= number_format($data7->disbursement_q_2, 2) == 0.00 ? '-' : number_format($data7->disbursement_q_2, 2) ?>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                        <?= number_format($data7->disbursement_q_3, 2) == 0.00 ? '-' : number_format($data7->disbursement_q_3, 2) ?>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                        <?= number_format($data7->disbursement_q_4, 2) == 0.00 ? '-' : number_format($data7->disbursement_q_4, 2) ?>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                        <?= number_format($data7->total_disbursement, 2) == 0.00 ? '-' : number_format($data7->total_disbursement, 2) ?>
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
        </div>
    </div>
</div>
