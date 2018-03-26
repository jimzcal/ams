<?php

use frontend\models\Images;
use sjaakp\cycle\Cycle;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Home';
$baseUrl = Yii::getAlias('@backend').'/web/';
?>
<div class="row">
    <div class="site-index">
        <div class="gallery">
            <?= $baseUrl; ?>
            <?= Html::img('backend/web/images/da-ams-logo.png', ['alt'=>'FMIS Banner', 'width' => '300px']);?>
            <?= Cycle::widget([
                'dataProvider' => $dataProvider,
                'imgAttribute' => function($data){

                        //$baseUrl = Yii::getAlias('@backend').'/web/';
                        return $data->url;
                    },
                // [
                //     'attribute' => 'imgAttribute',
                //     'value' => function($data){

                //         return $baseUrl.$data->url;
                //     }
                // ],
                'options' => [
                    'speed' => 2000,
                    'fx' => 'tileBlind',
                    'tileCount' => 26,
                    'tileVertical' => true,
                    'timeout' => 3000
                ],
            ]) ?>
        </div>
    </div>
</div>
