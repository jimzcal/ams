<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Nca */

$this->title = 'NCA: '.$model->nca_no;
// $this->params['breadcrumbs'][] = ['label' => 'Ncas', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="nca-view">

<!--     <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-right']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-right',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<table class="table table-bordered">
            <tr>
                <td>
                    <strong>Fund Cluster:</strong><br>
                    <?= $model->fund_cluster ?>
                </td>
                <td>
                    <strong>Date Received:</strong><br>
                    <?= $model->date_received ?>
                </td>
                <td colspan="2" rowspan="2">
                    <strong>Purpose:</strong><br>
                    <?= $model->purpose ?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>NCA No.:</strong><br>
                    <?= $model->nca_no ?>
                </td>
                <td>
                    <strong>Fiscal Year:</strong><br>
                    <?= $model->fiscal_year ?>
                </td>
            <tr>
                <td>
                    <strong>MDS Sub-account No.:</strong><br>
                    <?= $model->mds_sub_acc_no ?>
                </td>
                <td>
                    <strong>Total Amount:</strong><br>
                    <?= number_format($model->total_amount, 2) ?>
                </td>
                <td colspan="2">
                    <strong>GSB Branch:</strong><br>
                    <?= $model->gsb_branch ?>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="background-color: #f5f5f0">
                   <strong>MONTHLY CASH ALLOTMENT</strong> 
                </td>
            </tr>
            <tr>
                <td>
                    <strong>January:</strong><br>
                    <div class="amount-box">
                        <?= number_format($model->january, 2) ?>  
                    </div>
                   
                </td>
                <td>
                    <strong>February:</strong><br>
                    <div class="amount-box">
                        <?= number_format($model->february, 2) ?> 
                    </div>
                </td>
                <td>
                    <strong>March:</strong><br>
                    <div class="amount-box">
                        <?= number_format($model->march, 2) ?>
                    </div>
                    
                </td>
                <td>
                    <strong>April:</strong><br>
                    <div class="amount-box">
                        <?= number_format($model->april, 2) ?>
                    </div>
                    
                </td>
            </tr>
            <tr>
                <td>
                    <strong>May:</strong><br>
                    <div class="amount-box">
                         <?= number_format($model->may, 2) ?>
                    </div>
                    
                </td>
                <td>
                    <strong>June:</strong><br>
                    <div class="amount-box">
                        <?= number_format($model->june, 2) ?>
                    </div>
                    
                </td>
                <td>
                    <strong>July:</strong><br>
                    <div class="amount-box">
                         <?= number_format($model->july, 2) ?>
                    </div>
                    
                </td>
                <td>
                    <strong>August:</strong><br>
                    <div class="amount-box">
                        <?= number_format($model->august, 2) ?>
                    </div>
                    
                </td>
            </tr>
            <tr>
                <td>
                    <strong>September:</strong><br>
                    <div class="amount-box">
                         <?= number_format($model->september, 2) ?>
                    </div>
                    
                </td>
                <td>
                    <strong>October:</strong><br>
                    <div class="amount-box">
                         <?= number_format($model->october, 2) ?>
                    </div>
                    
                </td>
                <td>
                    <strong>November:</strong><br>
                    <div class="amount-box">
                         <?= number_format($model->november, 2) ?>
                    </div>
                    
                </td>
                <td>
                    <strong>December:</strong><br>
                    <div class="amount-box">
                         <?= number_format($model->december, 2) ?>
                    </div>
                    
                </td>
            </tr>
        </table>

</div>
