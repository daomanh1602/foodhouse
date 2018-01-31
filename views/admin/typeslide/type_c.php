<?php
$this->title =  Yii::t('appuser', 'Create type for slide');
Yii::$app->params['page_small_title'] =  Yii::t('appuser', 'Create type for slide');
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


?>

	<div class="grid-system">
		<div class="grid-hor">
			<h3 id="grid-example-basic"><?php echo $this->title?></h3>
		</div>
		<hr>
		<?php $form = ActiveForm::begin();?>
			<div class= "col-md-12">
				<div class="form-group">
					<?=$form->field($thePost, 'name_1')?>
				</div>
				<div class="form-group">
					<?=$form->field($thePost, 'name_2')?>
				</div>			
			</div>
			<div class="text-right"><?= Html::submitButton( Yii::t('app', 'Create new'), ['class' => 'btn btn-success']); ?></div>

		<?php ActiveForm::end(); ?>
	</div>
	<!---->
