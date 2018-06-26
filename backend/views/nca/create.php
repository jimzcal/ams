<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Nca */

$this->title = 'NOTICE OF CASH ALLOCATION';
// $this->params['breadcrumbs'][] = ['label' => 'Ncas', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="nca-create">
	<div class="new-title">
        <i class="fa fa-sticky-note" aria-hidden="true"></i> New Notice of Cash Allocation (NCA)
    </div>

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
    ]) ?>

</div>
