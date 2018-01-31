<?php
$this->title = 'Permission';
Yii::$app->params['page_small_title'] = 'Update Permission';
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

	<div class="grid-system">
		<div class="grid-hor">
			<h3 id="grid-example-basic"><?php echo $this->title;?></h3>
		</div>
		<hr>
		<?php $form = ActiveForm::begin();?>
			<div class="col-md-12">				
				<div class="form-group">
					<?= $form->field($thePermissionForm, 'name')?>
				</div>
				
				<div class="form-group">
					<?php foreach($list_action as $action ){ ?>
					
						<?= $form->field($thePermissionForm, $action , ['enableClientValidation'=>false])->checkboxList($list_val, ['multiple'=>'multiple']) ?>
					
					<?php } ?>
				</div> 
			</div>
			<div class="text-right"><?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']); ?></div>

		<?php ActiveForm::end(); ?>
	</div>
	<!---->