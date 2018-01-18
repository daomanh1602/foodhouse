<?php
$this->title = 'Permission';
Yii::$app->params['page_small_title'] = 'Create Permission';
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$list_action = [
	'c'=>'category',
	'p' => 'post',
	'pe' => 'permission',
	's' => 'slide'
];

$list_val = [
	'create' => 'create',
	'update' => 'update',
	'delete' => 'delete',
	'view' => 'view',
]

?>

<div class="grid-form">
	<div class="grid-form1">
		<h3 id="forms-example" class="">Create <?= $this->title ?> </h3>
		<? $form = ActiveForm::begin();?>
							
			<div class="form-group">
				<?=$form->field($thePermissionForm, 'name')?>
			</div>
			
			<div class="form-group">
				<? foreach($list_action as $action ){ ?>
				
					<?= $form->field($thePermissionForm, $action , ['enableClientValidation'=>false])->checkboxList($list_val, ['multiple'=>'multiple']) ?>
				
				<? } ?>
			</div> 

			<br/>
			<div class="text-right"><?= Html::submitButton('submit', ['class' => 'btn btn-default']); ?></div>

		<? ActiveForm::end(); ?>
	</div>
	<!---->
</div>