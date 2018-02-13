<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FundCluster */

$this->title = 'Update Fund Cluster: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Fund Clusters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fund-cluster-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
