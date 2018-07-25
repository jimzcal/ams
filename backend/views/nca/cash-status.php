<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
use miloschuman\highcharts\Highcharts;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\NcaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'NCA Status';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nca-index">
<?= Yii::$app->session->getFlash('error'); ?>

    <div class="new-title">
        <i class="fa fa-bar-chart-o" aria-hidden="true"></i> NCA Status
    </div>

    <div class="row" style="margin-left: auto; margin-right: auto; width: 90%;">
        <div class="col-md-6">
            <div style="background-color: #FFFFFF; border-radius: 10px; width: 100%; padding: 10px; margin-left: auto; margin-right: auto; height: 350px;">
                <table class="table table-striped" style="border: solid 1px #d9d9d9; border-radius: 15px;">
                    <tr>
                        <td style="text-align: right; font-style: italic; vertical-align: middle; width: 120px; color: #666666; font-size: 13px;">
                            NCA No.
                        </td>
                        <td style="color: green; font-weight: bold; vertical-align: middle; bold; width: 5px;">:</td>
                        <td><?= $nca_model->nca_no ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-style: italic; vertical-align: middle; width: 120px; color: #666666; font-size: 13px;">
                            Funding Source
                        </td>
                        <td style="color: green; font-weight: bold; vertical-align: middle; bold; width: 5px;">:</td>
                        <td><?= $nca_model->funding_source ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-style: italic; vertical-align: middle; width: 120px; color: #666666; font-size: 13px;">
                            Fund Cluster
                        </td>
                        <td style="color: green; font-weight: bold; vertical-align: middle; bold; width: 5px;">:</td>
                        <td><?= $nca_model->fund_cluster ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-style: italic; vertical-align: middle; width: 120px; color: #666666; font-size: 13px;">
                            Fiscal Year
                        </td>
                        <td style="color: green; font-weight: bold; vertical-align: middle; bold; width: 5px;">:</td>
                        <td><?= $nca_model->fiscal_year ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-style: italic; vertical-align: middle; width: 120px; color: #666666; font-size: 13px;">
                            NCA Type
                        </td>
                        <td style="color: green; font-weight: bold; vertical-align: middle; bold; width: 5px;">:</td>
                        <td><?= $nca_model->nca_type ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-style: italic; vertical-align: middle; width: 120px; color: #666666; font-size: 13px;">
                            Validity
                        </td>
                        <td style="color: green; font-weight: bold; vertical-align: middle; bold; width: 5px;">:</td>
                        <td><?= $nca_model->validity ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-style: italic; vertical-align: middle; width: 120px; color: #666666; font-size: 13px;">
                            Allocation
                        </td>
                        <td style="color: green; font-weight: bold; vertical-align: middle; bold; width: 5px;">:</td>
                        <td><?= number_format($nca_model->sub_total, 2) ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-style: italic; vertical-align: middle; width: 120px; color: #666666; font-size: 13px;">
                            Purpose
                        </td>
                        <td style="color: green; font-weight: bold; vertical-align: middle; bold; width: 5px;">:</td>
                        <td><?= $nca_model->purpose ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div style="background-color: #FFFFFF; border-radius: 10px; width: 100%; padding: 10px; margin-left: auto; margin-right: auto; height: 350px;">
                 <?= Highcharts::widget([
                    'options' => [
                        'chart' => [
                            'type' => 'bar',
                            'height' => '290',
                            ''
                        ],
                        'credits' => ['enabled' => false],
                        'title' => ['text' => 'As of '.$nca_model->lastdate],
                       // 'xAxis' => [
                       //    'categories' => ['Allotment/Earmarked', 'width' => '60%']
                       // ],
                       'yAxis' => [
                          'title' => ['text' => 'Earmarked']
                       ],
                       'series' => [
                          ['name' => 'Allotment', 'data' => [(int)$nca_model->sub_total]],
                          ['name' => 'Earmarked', 'data' => [(int)$nca_model->earmarked]]
                       ]

                    ]
                ]); ?>
            </div>
        </div>
    </div>
    <br>
    <div class="row" style="margin-left: auto; margin-right: auto; width: 90%;">
        <div class="col-md-12">
            <div style="background-color: #FFFFFF; border-radius: 10px; width: 100%; padding: 10px; margin-left: auto; margin-right: auto; height: auto;">
                <table class="table table-striped" style="border: solid 1px #d9d9d9; border-radius: 15px;">
                    <tr>
                        <th colspan="4" style="text-align: center;">Monthly Allocation and Status</th>
                    </tr>
                    <tr>
                        <th>Month</th>
                        <th>Allocation</th>
                        <th>Total Earmarked</th>
                        <th>Current Balance</th>
                    </tr>
                    <?php foreach (explode(',', $nca_model->validity) as $value) : ?>
                        <tr>
                            <td><?= $value ?></td>
                            <td><?= number_format($nca_model->getallocation($nca_model->nca_no, $nca_model->funding_source, $value), 2) ?></td>
                            <td><?= number_format($nca_model->getmearmarked($nca_model->nca_no, $nca_model->funding_source, $value), 2) ?></td>
                            <td><?= number_format(($nca_model->getAllocation($nca_model->nca_no, $nca_model->funding_source, $value) - $nca_model->getmearmarked($nca_model->nca_no, $nca_model->funding_source, $value)), 2) ?></td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
    </div>
    <br><br>
    <div class="view-index">
        <table class="table table-bordered table-striped">
            <tr>
                <th colspan="7" style="text-align: center;">Disbursements</th>
            </tr>
            <tr>
                <th style="text-align: center;">Date</th>
                <th style="text-align: center;">DV No.</th>
                <th style="text-align: center;">Payee</th>
                <th style="text-align: center;">Funding Source</th>
                <th style="text-align: center;">Gross Payment</th>
                <th style="text-align: center;">Less</th>
                <th style="text-align: center;">Net Payment</th>
            </tr>
            <?php if($dataProvider == null) : ?>
                <tr>
                    <td colspan="7" style="font-style: italic;">No Disbursements...</td>
                </tr>
            <?php endif ?>
            <?php foreach ($dataProvider as $key => $value) : ?>
                <tr>
                    <td><?= $value->date ?></td>
                    <td style="width: 170px;"><?= $value->dv_no ?></td>
                    <td style="width: 300px;"><?= $value->payee ?></td>
                    <td><?= $value->funding_source ?></td>
                    <td style="width: 130px; text-align: right; font-weight: bold;"><?= number_format($value->gross, 2) ?></td>
                    <td style="width: 130px; text-align: right; font-weight: bold;"><?= number_format($value->less, 2) ?></td>
                    <td style="width: 130px; text-align: right; font-weight: bold;"><?= number_format($value->amount, 2) ?></td>
                </tr>
        <?php endforeach ?>
        </table>
    </div>
</div>
