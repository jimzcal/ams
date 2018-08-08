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

        <?= Html::a('<span class="fa fa-line-chart fincial-report-icon-text" aria-hidden="true"></span><br>
            <span class="report-text">FINANCIAL REPORTS</span>', ["/far101/index"], ['class' => 'financial-report-icon']) ?>

        <?= Html::a('<span class="fa fa-paypal fincial-report-icon-text" aria-hidden="true"></span></br>
            <span class="report-text">INDEX OF PAYMENT</span>', ["/disbursement/index"], ['class' => 'financial-report-icon']) ?>

        <?= Html::a('<span class="fa fa-file-text-o fincial-report-icon-text"></span></br>
            <span class="report-text">LDDAP-ADA LIST</span>', ["/lddap-ada/index"], ['class' => 'financial-report-icon']) ?>

        <?= Html::a('<span class="fa fa-bar-chart-o fincial-report-icon-text"></span></br>
            <span class="report-text">NCA STATUS</span>', ["/nca/list"], ['class' => 'financial-report-icon']) ?>

        <?= Html::a('<span class="fa fa-id-card fincial-report-icon-text"></span></br>
            <span class="report-text">MONTHLY DISBURSEMENT</span>', ["/ors-registry/mdisbursement"], ['class' => 'financial-report-icon']) ?>

        <?= Html::a('<span class="fa fa-calculator fincial-report-icon-text"></span></br>
            <span class="report-text">TAXES</span>', ["/cash-status/index2"], ['class' => 'financial-report-icon']) ?>

        <?= Html::a('<span class="fa fa-money fincial-report-icon-text"></span></br>
            <span class="report-text">CASH ADVANCES</span>', ["/cash-advance/index"], ['class' => 'financial-report-icon']) ?>

        <?= Html::a('<span class="fa fa-file-text fincial-report-icon-text"></span></br>
            <span class="report-text">MONTHLY DISBURSEMENT PROGRAM</span>', ["/mdp/index"], ['class' => 'financial-report-icon']) ?>

        <!-- <?= Html::a('<span class="fa fa-file-o fincial-report-icon-text"></span></br>
            DAILY CASH REPORT</span>', ["/cash-status/index2"], ['class' => 'financial-report-icon']) ?> -->

        <?= Html::a('<span class="fa fa-clipboard fincial-report-icon-text"></span></br>
            <span class="report-text">OBLIGATION REGISTRY</span>', ["/ors-registry/index"], ['class' => 'financial-report-icon']) ?>

    </div>
</div>
