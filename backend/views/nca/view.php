<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Nca */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ncas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nca-view">

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
            'date',
            'nca_no',
            'fund_cluster',
            'mds_sub_acc_no',
            'gsb_branch',
            'purpose',
            'period',
            'amount',
        ],
    ]) ?>

</div>
