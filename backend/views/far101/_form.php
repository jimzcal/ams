<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Far101;
use backend\models\MfoPap;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use backend\models\FundCluster;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Far101 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="far101-form">

    <?php $form = ActiveForm::begin(); ?>
    <table style="width: 100%;">
        <tr>
            <td>
                <?= $form->field($model, 'fiscal_year')->textInput(['maxlength' => true]) ?>
            </td>
            <td>
                <?= $form->field($model, 'fund_cluster')->dropDownList(ArrayHelper::map(FundCluster::find()->all(),'fund_cluster','fund_cluster'),
                      [
                          'prompt'=>'Select Fund Cluster',
                      ]); 
                  ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?= $form->field($model, 'file')->widget(FileInput::classname(), [
                    'options' => ['multiple' => false, 'accept' => 'file/*'],
                    'pluginOptions' => ['previewFileType' => 'file', 'showUpload' => false, 'uploadUrl' => Url::to(['/far'])]
                ]); ?>
            </td>
        </tr>
    </table>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-default']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<!-- <script>
(function()
{
  if( window.localStorage )
  {
    if( !localStorage.getItem('firstLoad') )
    {
      localStorage['firstLoad'] = true;
      window.location.reload();
    }  
    else
      localStorage.removeItem('firstLoad');
  }
})();
</script> -->
