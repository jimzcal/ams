<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Ors */

$this->title = 'New ORS';
// $this->params['breadcrumbs'][] = ['label' => 'Ors', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="ors-create">

    <div class="new-title">
        <i class="fa fa-calculator" aria-hidden="true"></i> New Obligation Request and Status (ORS)
    </div>

    <div class="view-index">
	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	</div>

</div>
