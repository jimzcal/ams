<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\OrsRegistry */

$this->title = 'Obligation Entry';
//$this->params['breadcrumbs'][] = ['label' => 'Ors Registries', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="ors-registry-update">

    <div class="new-title">
        <i class="fa fa-sticky-note" aria-hidden="true"></i> <?= Html::encode($this->title) ?>
    </div>

    <?= $this->render('updateForm', [
    	//'model_registry' => $model_registry,
        //'model' => $model,
        'model' => $model,
    ]) ?>

</div>
