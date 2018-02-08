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
    <div class="financial-reports-panel">
        <div class="financial-report-icon">
            <span class="fa fa-line-chart" aria-hidden="true" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span></br>
            Financial Accountability Report
        </div>
        <div class="financial-report-icon">
            <span class="fa fa-paypal" aria-hidden="true" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span></br>
            Index of Payment
        </div>
        <div class="financial-report-icon">
            <span class="fa fa-file-text-o" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span></br>
            LDDAP-ADA List
        </div>
        <div class="financial-report-icon">
            <span class="fa fa-bar-chart-o" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span></br>
            Status of Cash Allocation
        </div>
        <div class="financial-report-icon">
            <span class="fa fa-id-card" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span></br>
            Paid DVs
        </div>
        <div class="financial-report-icon">
            <span class="fa fa-calculator" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span></br>
            Taxes
        </div>
        <div class="financial-report-icon">
            <span class="fa fa-money" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span></br>
            Cash Advances
        </div>
        <div class="financial-report-icon">
            <span class="fa fa-file-text" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span></br>
            Monthly Disbursement Program
        </div>
        <div class="financial-report-icon">
            <span class="fa fa-file-o" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span></br>
            Daily Cash Report
        </div>
    </div>
</div>
