<?php

use frontend\models\Images;
use sjaakp\cycle\Cycle;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Home';
?>
<div class="row">
    <div class="site-index">
        <div class="gallery">
            <?= Cycle::widget([
                'dataProvider' => $dataProvider,
                'imgAttribute' => function($data){

                        $baseUrl = Yii::getAlias('@mBackend/images');
                        return $baseUrl.'/'.$data->name;
                    },
                'options' => [
                    'speed' => 2000,
                    'fx' => 'tileBlind',
                    'tileCount' => 26,
                    'tileVertical' => true,
                    'timeout' => 3000,
                ],
            ]) ?>
        </div>
    </div>
</div>
