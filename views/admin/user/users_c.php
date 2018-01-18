<?php
$this->title = 'User';
Yii::$app->params['page_small_title'] = 'Create User';

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$userGenderList = [
		'0'=>'Male',
		'1'=>'Female',
];
?>

<div class="grid-form">
	<div class="grid-form1">
		<h3 id="forms-example" class="">Create user</h3>
		<? $form = ActiveForm::begin(['enableClientScript' => false]);?>
			<div class="form-group">
				<?=$form->field($theUser, 'username'); ?>
			</div>
			<div class="form-group">
				<?=$form->field($theUser, 'password'); ?>
			</div>
			<div class="form-group">
				<?=$form->field($theUser, 'f_name'); ?>
			</div>
			<div class="form-group">
				<?=$form->field($theUser, 'l_name'); ?>
			</div>	
			<div class="form-group">
				<?=$form->field($theUser, 'gender')->dropdownList($userGenderList) ?>
			</div>
			<div class="form-group">
				<?=$form->field($theUser, 'address'); ?>
			</div>	
			<div class="form-group">
				<?=$form->field($theUser, 'emails'); ?>
			</div>
			
			<div class="text-right"><?= Html::submitButton('submit', ['class' => 'btn btn-default']); ?></div>

		<? ActiveForm::end(); ?>
	</div>
	<!---->
</div>