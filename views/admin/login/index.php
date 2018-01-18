<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="col-md-12">
	<? $form = ActiveForm::begin();?>
	<div class="row">
		<div class="col-md-12">
			<?=$form->field($model, 'username'); ?>
		</div>
		<div class="col-md-12">
			<?=$form->field($model, 'password'); ?>
		</div>
				<div class="text-right">
		<div class="text-right"><?= Html::submitButton('Sign In'); ?></div>	
		</div>
	</div>
	<? ActiveForm::end(); ?>
</div>