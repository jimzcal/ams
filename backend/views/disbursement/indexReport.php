<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DisbursementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'FINANCIAL REPORTS';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disbursement-index">
    <div class="new-title">
        <i class="fa fa-book" aria-hidden="true"></i> Financial Records
    </div>

    <div class="financial-reports-panel">

        <?= Html::a('<span class="fa fa-line-chart" aria-hidden="true" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span></br>
            Financial Accountability Report', ["/far101/index"], ['class' => 'financial-report-icon']) ?>

        <?= Html::a('<span class="fa fa-paypal" aria-hidden="true" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span></br>
            Index of Payment', ["/disbursement/index"], ['class' => 'financial-report-icon']) ?>

        <?= Html::a('<span class="fa fa-file-text-o" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span></br>
            LDDAP-ADA List', ["/lddap-ada/index"], ['class' => 'financial-report-icon']) ?>

        <?= Html::a('<span class="fa fa-bar-chart-o" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span></br>
            Status of Cash Allocation', ["/nca/list"], ['class' => 'financial-report-icon']) ?>

        <?= Html::a('<span class="fa fa-id-card" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span></br>
        Monthly Disbursement Report', ["/ors-registry/disbursementyear"], ['class' => 'financial-report-icon']) ?>

        <?= Html::a('<span class="fa fa-calculator" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span></br>
            Taxes', ["/cash-status/index2"], ['class' => 'financial-report-icon']) ?>

        <?= Html::a('<span class="fa fa-money" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span></br>
            Cash Advances', ["/cash-advance/index"], ['class' => 'financial-report-icon']) ?>

        <?= Html::a('<span class="fa fa-file-text" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span></br>
            Monthly Disbursement Program', ["/orsRegistry/mDisbursement"], ['class' => 'financial-report-icon']) ?>

        <!-- <?= Html::a('<span class="fa fa-file-o" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span></br>
            Daily Cash Report', ["/cash-status/index2"], ['class' => 'financial-report-icon']) ?> -->

        <?= Html::a('<span class="fa fa-clipboard" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span></br>
            Obligation Registry', ["/ors-registry/index"], ['class' => 'financial-report-icon']) ?>

    </div>
</div>
