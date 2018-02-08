<div class="accounting-modal">
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Nca */

$this->title = 'NOTICE OF CASH ALLOCATION';
// $this->params['breadcrumbs'][] = ['label' => 'Ncas', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="nca-create">
	<div class="small-form-wrapper">
		<div class="modal-header">
			<div class="title">
                <?= Html::encode($this->title) ?>
                <?= Html::a('&times;', ['/nca/index'], ['class' => 'close']) ?>
            </div>
	    </div>
	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	</div>
</div>

</div>
