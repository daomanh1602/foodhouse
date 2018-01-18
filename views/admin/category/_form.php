<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\admin\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Testtbl */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="testtbl-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($theForm, 'name')->textInput(['maxlength' => true]) ?>

	<div class="form-group ">
		<?= Html::label('Parent', 'parent',['class'=>'control-label'])?>
		<?= Html::dropDownList(
			'Category[parentId]',
			$model->parentId,
			Category::getTree($model->id),
			['prompt'=>	'Select parent ','class'=>'form-control-group']	
		)?>
	</div>

    <?php $form->field($model, 'position')->textInput(['type'=>'number']) ?>

	<?= $form->field($theForm, 'description')->textarea(['rows'=>5,'maxlength' => true]) ?>
	
	<?= $form->field($theForm, 'content')->textArea(['rows'=>15,'maxlength' => true])?>
	
	<?= $form->field($theForm, 'seo_title')->textInput(['maxlength' => true])?>
	
	<?= $form->field($theForm, 'seo_description')->textArea(['rows'=>5,'maxlength' => true])?>
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
