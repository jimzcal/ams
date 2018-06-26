<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DvLog */

$this->title = 'Update Dv Log: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dv Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dv-log-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
