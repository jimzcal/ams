<div class="accounting-modal">
	<?php
	use yii\helpers\Html;


	/* @var $this yii\web\View */
	/* @var $model backend\models\AccountingEntry */

	$this->title = 'Accounting Entry';
	$this->params['breadcrumbs'][] = ['label' => 'Accounting Entries', 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
	?>
	<div class="accounting-entry-create">
		<div class="modal-content">
		      <div class="modal-header">
		         <?= Html::a('&times;', ['/disbursement/processor', 'id' => $id], ['class' => 'close']) ?>
		        <div class="title">
			        <?= Html::encode($this->title) ?>
			    </div>
		      </div>
		      <div class="modal-body">
				    <?= $this->render('_form', [
				        'model' => $model,
				        'dv_no' => $dv_no,
				        'net' => $net,
				    ]) ?>
		      </div>
		</div>
	</div>
</div>


