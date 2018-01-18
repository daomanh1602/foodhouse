<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\admin\Slide;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Testtbl */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="testtbl-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'enableClientScript' => false]) ?>

	<div class="form-group ">
        
        <?= $form->field($theForm, 'avatar')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*'],'pluginOptions' => ['showUpload' => false,'showCancel' => false,]]); ?>
	</div>
				
    <?= $form->field($theForm, 'name')->textInput(['maxlength' => true]) ?>


	<?= $form->field($theForm, 'description')->textarea(['rows'=>5,'maxlength' => true]) ?>
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

