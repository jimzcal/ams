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
            <div style="background-color: #FFFFFF; border-radius: 10px; width: 100%; padding: 10px; margin-left: auto; margin-right: auto; height: 300px;">
                <table class="table table-striped">
                    <tr>
                        <td style="text-align: right; font-style: italic; vertical-align: middle; width: 120px; color: #666666; font-size: 13px;">
                            NCA No.
                        </td>
                        <td style="color: green; font-weight: bold; vertical-align: middle; bold; width: 5px;">:</td>
                        <td><?= $nca_model->nca_no ?></td>
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
                        <td><?= number_format($nca_model->total_amount, 2) ?></td>
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
            <div style="background-color: #FFFFFF; border-radius: 10px; width: 100%; padding: 10px; margin-left: auto; margin-right: auto; height: 300px;">
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
                          ['name' => 'Allotment', 'data' => [(int)$nca_model->total_amount]],
                          ['name' => 'Earmarked', 'data' => [(int)$nca_model->earmarked]]
                       ]

                    ]
                ]); ?>
            </div>
        </div>
    </div>
    <br><br>
    <div class="view-index">
        <table class="table table-bordered table-striped">
            <tr>
                <th style="text-align: center;">Date</th>
                <th style="text-align: center;">DV No.</th>
                <th style="text-align: center;">Payee</th>
                <th style="text-align: center;">Funding Source</th>
                <th style="text-align: center;">Gross Payment</th>
                <th style="text-align: center;">Less</th>
                <th style="text-align: center;">Net Payment</th>
            </tr>
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
