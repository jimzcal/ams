<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Transaction */

$this->title = $model->name;
// $this->params['breadcrumbs'][] = ['label' => 'Transactions', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-view">

    <div class="title"></div>
        <p>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-right',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-right']) ?>
    </p>
    <div class="new-title">
        <i class="fa fa-tasks" aria-hidden="true"></i> <?= Html::encode($this->title) ?>
        <p style="text-indent: 28px; font-size: 14px;">Documentary Requirements</p>
    </div>

    <div class="view-index">
        <table class="table table-bordered table-striped">
            <tr>
                <td style="width: 230px;">
                    <label>Transaction</label>
                </td>
                <td>
                    <?= $model->name ?>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Documentary Requirements</label>
                </td>
                <td>
                    <?php $val = explode(',', $model->requirements) ?>

                    <?php for ($i=0; $i<sizeof($val); $i++) : ?>

                        <div style="display: block"><?= ($i+1).'. '.$val[$i] ?></div>

                    <?php endfor ?>
                </td>
            </tr>
        </table>
    </div>

</div>
