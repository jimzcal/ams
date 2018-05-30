<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrsRegistrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registry of Obligation';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ors-registry-index">

    <div class="new-title">
        <i class="fa fa-calculator" aria-hidden="true"></i> Registry of Obligations
    </div>

    <?php Pjax::begin(); ?>
    <div style=" padding: 0; width: 88%; margin-left: auto; margin-right: auto; display: block;">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <div class="view-index">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'date',
                [
                    'label' => 'ORS No.',
                    'value' => function($data){
                        $ors_no = $data->ors_class.'-'.$data->funding_source.'-'.$data->ors_year.'-'.$data->ors_month.'-'.$data->ors_serial;
                        return $ors_no;
                    }
                ],
                // 'ors_class',
                // 'funding_source',
                // 'ors_year',
                //'ors_month',
                //'ors_serial',
                'mfo_pap',
                'responsibility_center',
                'obligation',
                'payable',
                'payment',

                //['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
     </div>

    <?php Pjax::end(); ?>
</div>
