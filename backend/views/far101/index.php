<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\Far101Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'FAR 1 - 01';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="far101-index">

    <div class="title">
        <?= Html::a('FAR Template', ['new'], ['class' => 'btn btn-success btn-right']) ?>
    </div>

    <div class="new-title">
        <i class="fa fa-line-chart" aria-hidden="true"></i> Financial Accountability Report (FAR 1)
    </div>

    <div style=" padding: 0; width: 88%; margin-left: auto; margin-right: auto; display: block;">
        <div class="row">
            <div class="col-md-8">
                <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>
            <div class="col-md-4">
                <div style="float: right;">
                    <?= ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            //'id',
                            'fiscal_year',
                            'fund_cluster',
                            'parent_id',
                            'particulars',
                            'uacs_code',
                            'obligation_q_1',
                            'obligation_q_2',
                            'obligation_q_3',
                            'obligation_q_4',
                            'total_obligation',
                            'disbursement_q_1',
                            'disbursement_q_2',
                            'disbursement_q_3',
                            'disbursement_q_4',
                            'total_disbursement',
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="view-index">
         <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'fiscal_year',
                    'fund_cluster',
                    //'parent_id',
                    'particulars',
                    'uacs_code',
                    //'obligation_q_1',
                    //'obligation_q_2',
                    //'obligation_q_3',
                    //'obligation_q_4',
                    'total_obligation',
                    //'disbursement_q_1',
                    //'disbursement_q_2',
                    //'disbursement_q_3',
                    //'disbursement_q_4',
                    'total_disbursement',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
