<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CashAdvance */

$this->title = 'CASH ADVANCES';
$this->params['breadcrumbs'][] = ['label' => 'Cash Advances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cash-advance-create">

    <div class="form-wrapper">
    	<div class="title">
    		<?= Html::encode($this->title) ?>
    	</div>

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	</div>

</div>
