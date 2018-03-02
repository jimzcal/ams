<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */

$this->title = 'NEW DISBURSEMENT VOUCHER';
// $this->params['breadcrumbs'][] = ['label' => 'Disbursements', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="disbursement-create">
    <div class="form-wrapper" id="form-wrapper">
    	<div class="title">
    		<?= Html::encode($this->title) ?>
    		<?= Html::a('&times;', ['/disbursement/index'], ['class' => 'close']) ?>
    	</div>

	    <?= $this->render('_form', [
	        'model' => $model,
	        'dv_no' => $dv_no,
	    ]) ?>
	</div>
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
