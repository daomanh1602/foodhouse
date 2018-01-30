<?php
$this->title = 'Type slide';
Yii::$app->params['page_small_title'] = 'Update type';
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


?>

<div class="grid-form">
	<div class="grid-form1">
		<h3 id="forms-example" class="">Create Type slide</h3>
		<?php $form = ActiveForm::begin();?>
			
			<div class="form-group">
				<?=$form->field($thePost, 'name_1')?>
			</div>
			<div class="form-group">
				<?=$form->field($thePost, 'name_2')?>
			</div>
			
			<br/>
			<div class="text-right"><?= Html::submitButton('submit', ['class' => 'btn btn-default']); ?></div>

		<?php ActiveForm::end(); ?>
	</div>
	<!---->
</div>