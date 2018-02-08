<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountingEntry */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Accounting Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounting-entry-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'dv_no',
            'account_title',
            'uacs_code',
            'debit',
            'credit_amount',
            'credit_to',
        ],
    ]) ?>

</div>
