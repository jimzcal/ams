<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact Us';
?>
<?= Yii::$app->view->renderFile('@app/views/layouts/navbar.php') ?>

<div class="site-contact">
  <section id="contact" class="container-fluid">
    <div class="container">
      <h1 class="contact-header">
        <i class="fa fa-envelope" aria-hidden="true"></i>
        <?= Html::encode($this->title) ?>
      </h1>
      <hr>
      <p class="contact-desc">If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.</p>
      
      <div class="row">
        <div class="col-md-6">
          <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
          
            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'subject') ?>

            <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', [
                  'class' => 'btn btn-primary btn-lg float-right', 'name' => 'contact-button',
                  'style' => 'cursor: pointer;'
                  ]) ?>
            </div>
          <?php ActiveForm::end(); ?>
        </div>
        <div class="col-md-6">
          <h2>PPEI Project Management Office</h2>
          <h4>Bureau of Local Government Development</h4>
          <h4>Department of the Interior and Local Government</h4>
          <hr>
          <iframe width="100%" height="450" frameborder="0" style="border:0"
            src="https://www.google.com/maps/embed/v1/place?q=DILG%20NAPOLCOM&key=AIzaSyCnO5ud0AQXw38v6CWmNujOeksxvjqUdfk" 
            allowfullscreen></iframe>
          <hr>
          <h5><i class="fa fa-map-marker" aria-hidden="true"></i> 25th Floor, DILG-NAPOLCOM Center, EDSA cor. <br> Quezon Avenue, Quezon City, PH</h5>
          <h5><i class="fa fa-phone" aria-hidden="true"></i> +632 929 92 35; +632 927 78 52</h5>
          <h5><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:ppei_dilg@yahoo.com">ppei_dilg@yahoo.com</a></h5>
        </div>
      </div>
    </div>
  </section>
</div>
