<?php
$this->title = Yii::t('appuser', 'Create user');
Yii::$app->params['page_small_title'] = Yii::t('appuser', 'Create user');

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
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


	<div class="grid-system">
		<div class="grid-hor">
			<h3 id="grid-example-basic"><?php echo $this->title;?></h3>
		</div>
		<hr>
		
		<?php $form = ActiveForm::begin(['enableClientScript' => false]);?>
		<div class= "col-md-12">
			<div class="col-md-6 col-sm-12" style="height:auto;">
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
			</div>
			
			<div class="col-md-6" style=" height:auto;">
					<div class="form-group">               
						<?= $form->field($theUser, 'avatar')
												->widget( FileInput::classname(), [ 
															'options' => ['accept' => 'image/*'],
															'pluginOptions' => [
																'showUpload' => false,
																'showCancel' => false,
																'showRemove' => false,
																'initialPreview'=>[
																	$theUser->avatar,                                                            
																],
																'initialPreviewAsData'=>true,
																'initialCaption'=>$theUser->avatar,
																'initialPreviewConfig' => [                                                        
																	['caption' => $theUser->avatar, 'size' => '1287883'],
																],
																'overwriteInitial'=>true,
																'maxFileSize'=>2800
															] ,														
												]); 
						?>
					</div>
			</div>
		</div>
		<div class="text-right"><?= Html::submitButton( Yii::t('app', 'Create new'), ['class' => 'btn btn-success']); ?></div>

		<?php ActiveForm::end(); ?>
	</div>
	<!---->
