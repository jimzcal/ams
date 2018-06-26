<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Employees */

$this->title = $model->name;
// $this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-view">

    <div class="new-title">
        <i class="fa fa-group" aria-hidden="true"></i> <?= Html::encode($this->title) ?>
    </div>
    
    <div style="width: 900px; margin-right: auto; margin-left: auto; border-right: 10px; background-color: #FFFFFF; margin-top: 10px; padding: 10px;">
        <table class="table table-bordered table-condensed">
            <tr style="height: 140px;">
                <td colspan="2" style="text-align: center; padding: 25px; color: #737373;">
                    <h2>EMPLOYEE'S PROFILE FORM</h2>
                </td>
                <td width="250"></td>
            </tr>
            <tr>
                <td style="width: 150px; font-size: 12px; color: #8c8c8c; font-style: italic; text-align: right; vertical-align: middle;;">Name :</td>
                <td style="height: 35px;">
                    <?= $model->name ?>
                </td>
                <td style="height: 35px;">
                    ID:
                    <?= $model->employee_id ?>
                </td>
            </tr>
            <tr>
                <td style="width: 150px; font-size: 12px; color: #8c8c8c; font-style: italic; text-align: right; vertical-align: middle;;">Position :</td>
                <td colspan="2" style="height: 35px;">
                    <?= $model->position ?>
                </td>
            </tr>
            <tr>
                <td style="width: 150px; font-size: 12px; color: #8c8c8c; font-style: italic; text-align: right; vertical-align: middle;;">Office :</td>
                <td colspan="2" style="height: 35px;">
                    <?= $model->office ?>
                </td>
            </tr>
            <tr>
                <td style="width: 150px; font-size: 12px; color: #8c8c8c; font-style: italic; text-align: right; vertical-align: middle;;">Password :</td>
                <td colspan="2" style="height: 35px;">
                    <?= '...Hidden...' ?>
                </td>
            </tr>
            <tr>
                <td style="width: 150px; font-size: 12px; color: #8c8c8c; font-style: italic; text-align: right; vertical-align: middle;;">Biometrix :</td>
                <td colspan="2" style="height: 35px;">
                    <?= '...Hidden...' ?>
                </td>
            </tr>
            <tr>
                <td style="width: 150px; font-size: 12px; color: #8c8c8c; font-style: italic; text-align: right; vertical-align: middle;;">QR Code :</td>
                <td colspan="2" style="height: 35px;">
                    <?= '...Hidden...' ?>
                </td>
            </tr>
        </table>
    </div>
</div>
