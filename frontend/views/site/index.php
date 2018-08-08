<?php

use frontend\models\Images;
use sjaakp\cycle\Cycle;
use yii\helpers\Html;

/* @var $this yii\web\View */
$exec = exec("hostname");
$hostname = trim($exec);
$ip = gethostbyname($hostname);

$this->title = 'Home';
?>

<?php if($hostname == 'ams-accounting') : ?>
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
                        'speed' => 3000,
                        'fx' => 'tileSlide',
                        'tileCount' => 18,
                        'tileVertical' => true,
                        'timeout' => 16000,
                    ],
                ]) ?>
            </div>
        </div>
    </div>

<?php else: ?>
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
                        'speed' => 3000,
                        'fx' => 'tileSlide',
                        'tileCount' => 18,
                        'tileVertical' => true,
                        'timeout' => 16000,
                    ],
                ]) ?>
            </div>
        </div>
    </div>
<?php endif ?>

