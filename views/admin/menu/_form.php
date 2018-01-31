<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\admin\Menu;

/* @var $this yii\web\View */
/* @var $model app\models\Testtbl */
/* @var $form yii\widgets\ActiveForm */

?>



    <?php $form = ActiveForm::begin(); ?>
	<div class="col-md-12">
		<?= $form->field($theForm, 'name')->textInput(['maxlength' => true]) ?>

		<div class="form-group ">
			<?= Html::label('Parent', 'parent',['class'=>'control-label'])?>
			<?= Html::dropDownList(
				'Menu[parentId]',
				$model->parentId,
				Menu::getTree($model->id),
				['prompt'=>	'Select parent ','class'=>'form-control-group']	
			)?>
		</div>

		<?= $form->field($theForm, 'url')->textInput(['maxlength' => true]) ?>
	</div>

    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create new') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>


    <?php ActiveForm::end(); ?>


