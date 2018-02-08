<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TblattributeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Attributes';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblattribute-index">
    <!-- <div class="panel-header-wrapper">
        <?= Yii::$app->session->getFlash('error'); ?>
        <h3><?= Html::encode($this->title) ?></h3>
    </div> -->
    <?php $form = ActiveForm::begin(); ?>

    <!-- <h2>Stylish Search Box</h2> -->
        <div id="custom-search-input">
            <div class="input-group col-md-12">
                <input type="text" name="data" class="search-query form-control" placeholder="Search" value=<?= !empty($data) ? $data : null ?> />
                <span class="input-group-btn">
                    <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span>', ['class' => 'btn btn-danger']) ?>
                </span>
            </div>
        </div>
    <?php ActiveForm::end(); ?>

<?php if(!empty($query) || !empty($query2) || !empty($query3)) : ?>
    <div class="result">Results:</div>

    <?php if(!empty($query)) : ?>
        <?php foreach ($query as $value) : ?>
            <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-right"></span> '.mb_strimwidth($value->value, 0, 110, ' ...'), ['tblcontent/view', 'id' => $value->id], ['class' => 'results']); ?>
        <?php endforeach ?>
    <?php endif ?>

    <?php if(!empty($query2)) : ?>
        <?php foreach ($query2 as $value2) : ?>
           <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-right"></span> '.mb_strimwidth($value2->name, 0, 110, ' ...'), ['tblfile/view', 'file_id' => $value2->id, 'folder_id' => $value2->folder_id], ['class' => 'results']); ?>
        <?php endforeach ?>
    <?php endif ?>

    <?php if(!empty($query3)) : ?>
        <?php foreach ($query3 as $value3) : ?>
            <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-right"></span> '.mb_strimwidth($value3->file_name, 0, 110, ' ...'), ['tblhub/view', 'id' => $value3->id], ['class' => 'results']); ?>
        <?php endforeach ?>
    <?php endif ?>

<?php endif ?>

    <?php if(empty($query) && empty($query2) && empty($query3)) : ?>
        <div class="result">No results found</div>
    <?php endif ?>
</div>
