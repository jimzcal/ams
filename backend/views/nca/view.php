<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use backend\models\Nca;

/* @var $this yii\web\View */
/* @var $model backend\models\Nca */

$this->title = 'NCA: '.$model->nca_no;
// $this->params['breadcrumbs'][] = ['label' => 'Ncas', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="nca-view">

<!--     <h1><?= Html::encode($this->title) ?></h1> -->


    <div class="btn-group btn-group-vertical" style="float: left; left: 0; z-index: 300; position: fixed;" id="noprint">
        <?= Html::a('<i class="glyphicon glyphicon-arrow-left"></i>', ["/nca/index"], ['class' => 'btn btn-default']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-pencil" style= "font-size: 14px;"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-trash" style= "font-size: 14px;"></i>', ['delete', 'id' => $model->id], ['class' => 'btn btn-default',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?> 
    </div>

    <div class="new-title">
        <i class="fa fa-sticky-note" aria-hidden="true"></i> Notice of Cash Allocation (NCA) <br>
        <p style="font-size: 14px; text-indent: 23px;">NCA No. <?= $model->nca_no ?></p>
    </div>

    <div class="view-index">
        <div class="mini-header">
            <i class="glyphicon glyphicon-list-alt"></i> NCA Details
        </div>
        <table class="table table-striped">
                    <tr>
                        <td style="text-align: right; font-style: italic; vertical-align: middle; width: 120px; color: #666666; font-size: 13px;">
                            NCA No.
                        </td>
                        <td style="color: green; font-weight: bold; vertical-align: middle; bold; width: 5px;">:</td>
                        <td><?= $model->nca_no ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-style: italic; vertical-align: middle; width: 120px; color: #666666; font-size: 13px;">
                            Fund Cluster
                        </td>
                        <td style="color: green; font-weight: bold; vertical-align: middle; bold; width: 5px;">:</td>
                        <td><?= $model->fund_cluster ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-style: italic; vertical-align: middle; width: 120px; color: #666666; font-size: 13px;">
                            Fiscal Year
                        </td>
                        <td style="color: green; font-weight: bold; vertical-align: middle; bold; width: 5px;">:</td>
                        <td><?= $model->fiscal_year ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-style: italic; vertical-align: middle; width: 120px; color: #666666; font-size: 13px;">
                            NCA Type
                        </td>
                        <td style="color: green; font-weight: bold; vertical-align: middle; bold; width: 5px;">:</td>
                        <td><?= $model->nca_type ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-style: italic; vertical-align: middle; width: 120px; color: #666666; font-size: 13px;">
                            Validity
                        </td>
                        <td style="color: green; font-weight: bold; vertical-align: middle; bold; width: 5px;">:</td>
                        <td><?= $model->validity ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-style: italic; vertical-align: middle; width: 120px; color: #666666; font-size: 13px;">
                            Allocation
                        </td>
                        <td style="color: green; font-weight: bold; vertical-align: middle; bold; width: 5px;">:</td>
                        <td><?= number_format($model->total_amount, 2) ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-style: italic; vertical-align: middle; width: 120px; color: #666666; font-size: 13px;">
                            Purpose
                        </td>
                        <td style="color: green; font-weight: bold; vertical-align: middle; bold; width: 5px;">:</td>
                        <td><?= $model->purpose ?></td>
                    </tr>
                </table>
    </div> 

    <div class="view-index">
        <div class="mini-header">
            <i class="glyphicon glyphicon-calendar"></i> MONTHLY REQUIREMENTS SCHEDULE
        </div>
        <?php foreach ($nca as $value) : ?>
            <table class="table table-bordered table-striped table-condensed" style="width: 98%; margin-right: auto; margin-left: auto; margin-bottom: 20px;">
                <tr>
                    <th>FUNDING SOURCE</th>
                    <th>MDS SUB-ACCOUNT NO.</th>
                    <th width="300">GSB BRANCH</th>
                    <th>VALIDITY</th>
                </tr>
                <tr>
                    <td><?= $value->funding_source ?></td>
                    <td><?= $value->mds_sub_acc_no ?></td>
                    <td><?= $value->gsb_branch ?></td>
                    <td>
                        <?php
                            $val = explode(',',$value->validity);
                            if(sizeof($val) == 12)
                            {
                                echo "Whole Year";
                            }

                            else
                            {
                                foreach ($val as $month)
                                {
                                    echo ucfirst($month);
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table class="table table-striped table-condensed table-bordered" style=" margin-right: auto; margin-left: auto; width: 98%">
                            <tr>
                                <td style="font-weight: bold; text-align: center;" colspan="2">First Quarter</td>
                                <td style="font-weight: bold; text-align: center;" colspan="2">Second Quarter</td>
                                <td style="font-weight: bold; text-align: center;" colspan="2">Third Quarter</td>
                                <td style="font-weight: bold; text-align: center;" colspan="2">Forth Quarter</td>
                            </tr>
                            <tr style="height: 35px;">
                                <td>January</td>
                                <td><?= number_format($value->january, 2) ?></td>
                                <td>April</td>
                                <td><?= number_format($value->april, 2) ?></td>
                                <td>July</td>
                                <td><?= number_format($value->july, 2) ?></td>
                                <td>October</td>
                                <td><?= number_format($value->october, 2) ?></td>
                            </tr>
                            <tr>
                               
                                <td>February</td>
                                <td><?= number_format($value->february , 2)?></td>
                                <td>May</td>
                                <td><?= number_format($value->may, 2) ?></td>
                                <td>August</td>
                                <td><?= number_format($value->august, 2) ?></td>
                                <td>November</td>
                                <td><?= number_format($value->november, 2) ?></td>
                            </tr>
                            <tr style="height: 35px;">
                                <td>March</td>
                                <td><?= number_format($value->march, 2) ?></td>
                                <td>June</td>
                                <td><?= number_format($value->june, 2) ?></td>
                                <td>September</td>
                                <td><?= number_format($value->september, 2) ?></td>
                                <td>December</td>
                                <td><?= number_format($value->december, 2) ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold; font-size: 14px;">TOTAL</td>
                                <td style="font-weight: bold; font-size: 14px;"><?= number_format($value->first_quarter, 2)?></td>
                                <td style="font-weight: bold; font-size: 14px;">TOTAL</td>
                                <td style="font-weight: bold; font-size: 14px;"><?= number_format($value->second_quarter, 2) ?></td>
                                <td style="font-weight: bold; font-size: 14px;">TOTAL</td>
                                <td style="font-weight: bold; font-size: 14px;"><?= number_format($value->third_quarter, 2)?></td>
                                <td style="font-weight: bold; font-size: 14px;">TOTAL</td>
                                <td style="font-weight: bold; font-size: 14px;"><?= number_format($value->forth_quarter, 2)?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        <?php endforeach ?>
    </div> 

</div>

<?php
$this->registerJs("
    $('tbody th').css('text-align', 'center');
    "); 
?>
