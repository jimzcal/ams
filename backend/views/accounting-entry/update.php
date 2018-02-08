<?php

use yii\helpers\Html;

	/* @var $this yii\web\View */
	/* @var $model backend\models\AccountingEntry */
?>
<div class="accounting-modal">
<?php 

$this->title = 'UPDATE: '.$model->account_title;
$this->params['breadcrumbs'][] = ['label' => 'Accounting Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

?>
	<div class="accounting-entry-update">
	    <div class="accounting-entry">
	    	<?= Html::a('&times;', ['/disbursement/processor', 'id' => $dv_id], ['class' => 'close']) ?>
	    	<div class="title">
	        	<?= Html::encode($this->title) ?>
	    	</div>
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>
</div>
