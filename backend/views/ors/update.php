<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Ors */

$this->title = 'Update ORS';
// $this->params['breadcrumbs'][] = ['label' => 'Ors', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="ors-update">

    <div class="new-title">
        <i class="fa fa-calculator" aria-hidden="true"></i> Update Obligation Request and Status (ORS)
    </div>

    <div class="view-index">
	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	</div>
</div>
