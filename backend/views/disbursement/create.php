<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */

$this->title = 'NEW DISBURSEMENT VOUCHER';
// $this->params['breadcrumbs'][] = ['label' => 'Disbursements', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="disbursement-create">
 
    	<div class="new-title">
	        <i class="fa fa-id-card" aria-hidden="true"></i> New Disbursement Voucher
	    </div>

	    <?= $this->render('_form', [
	        'model' => $model,
	        'dv_no' => $dv_no,
	        'reference' => $reference,
	    ]) ?>

</div>

<script type="text/javascript">

function myFunction() {
	document.getElementById("#max").style.width = "100%";
	document.getElementById("max").style.margin-top = "0";
	document.getElementById("max").style.position = "absolute";
	document.getElementById("p2").style.fontFamily = "Arial";
	document.getElementById("p2").style.fontSize = "larger";
}
</script>
