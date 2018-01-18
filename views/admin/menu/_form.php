<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\admin\Menu;

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
			'Menu[parentId]',
			$model->parentId,
			Menu::getTree($model->id),
			['prompt'=>	'Select parent ','class'=>'form-control-group']	
		)?>
	</div>

	<?= $form->field($theForm, 'url')->textInput(['maxlength' => true]) ?>
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
