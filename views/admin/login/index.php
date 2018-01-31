<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="col-md-12">
	<?php $form = ActiveForm::begin();?>
	<div class="row">
		<div class="col-md-12">
			<?=$form->field($model, 'username'); ?>
		</div>
		<div class="col-md-12">
			<?=$form->field($model, 'password')->passwordInput(); ?>
		</div>
				<div class="text-right">
		<div class="text-right"><?= Html::submitButton('Sign In'); ?></div>	
		</div>
	</div>
	<?php ActiveForm::end(); ?>
</div>