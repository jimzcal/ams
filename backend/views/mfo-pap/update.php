<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MfoPap */

$this->title = 'Update Mfo Pap: '.$model->description;
// $this->params['breadcrumbs'][] = ['label' => 'Mfo Paps', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="mfo-pap-update">

    <div class="form-wrapper">
		<div class="form-title">
			Update <?= $model->description ?>
			<?= Html::a('&times;', ['/mfo-pap/index'], ['class' => 'close-button']) ?>
		</div>
		<div style="padding: 15px;">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>

</div>
