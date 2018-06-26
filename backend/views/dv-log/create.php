<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DvLog */

$this->title = 'DV Log';
// $this->params['breadcrumbs'][] = ['label' => 'Dv Logs', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="dv-log-create">
<!-- 
      <div class="new-title">
        <i class="fa fa-id-card" aria-hidden="true"></i> Disbursement Vouchers Log
      </div> -->

    <div style="width: 400px; margin-left: auto; margin-right: auto; padding: 20px; margin-top: 100px; background-color: #FFFFFF; ">
    	<div style="margin-left: auto; margin-right: auto; width: 100%; text-align: center;">
	    	<i class="fa fa-user-o" aria-hidden="true"></i> Employee's ID
	    </div><br>
	    <i>Ask for Employee's Identity who made this transaction.</i><br>
	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	</div>
</div>
