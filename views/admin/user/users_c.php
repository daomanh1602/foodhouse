<?php
$this->title = 'User';
Yii::$app->params['page_small_title'] = 'Create User';

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$userGenderList = [
		'0'=>'Male',
		'1'=>'Female',
];

$userStatus = [
	'2' => 'cho duyet',
	'1' => 'hoat dong',
	'0' => 'xoa',

]
?>

<div class="grid-form">
	<div class="grid-form1">
		<h3 id="forms-example" class="">Create user</h3>
		<?php $form = ActiveForm::begin(['enableClientScript' => false]);?>
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

			<div class="form-group">
				<?=$form->field($theUser, 'id_permission')->dropDownList(ArrayHelper::map($list_permission, 'id', 'permission_name')); ?>
			</div>
			
			<div class="form-group">
				<?=$form->field($theUser, 'status_acc')->dropDownList($userStatus); ?>
			</div>

			<div class="text-right"><?= Html::submitButton('submit', ['class' => 'btn btn-default']); ?></div>

		<?php ActiveForm::end(); ?>
	</div>
	<!---->
</div>