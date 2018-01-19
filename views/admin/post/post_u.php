<?php
$this->title = 'Post';
Yii::$app->params['page_small_title'] = 'Update post';
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$list_parent = [];

foreach ($theCategoryHas as $t){
	$list_parent[]= ['id'=>$t['id'],'name'=> str_repeat('--', $t['depth']). ' ' .$t['category_detail']['name']];
}

?>

<div class="grid-form">
	<div class="grid-form1">
		<h3 id="forms-example" class="">Update Post</h3>
		<?php $form = ActiveForm::begin();?>
			<div class="form-group">
				<?=$form->field($thePostForm, 'cate_id')->dropDownList(ArrayHelper::map($list_parent, 'id', 'name')); ?>
			</div>						
			<div class="form-group">
				<?=$form->field($thePostForm, 'name')?>
			</div>
			<div class="form-group">
				<?=$form->field($thePostForm, 'description')->textArea(['rows'=>5])?>
			</div>
			<div class="form-group">
				<?=$form->field($thePostForm, 'content')->textArea(['rows'=>20])?>
			</div>
			<div class="form-group">
				<?=$form->field($thePostForm, 'tag')?>
			</div>
			<div class="form-group">
				<?=$form->field($thePostForm, 'seo_title')?>
			</div>
			<div class="form-group">
				<?=$form->field($thePostForm, 'seo_description')->textArea(['rows'=>5])?>
			</div>
			<br/>
			<div class="text-right"><?= Html::submitButton('submit', ['class' => 'btn btn-default']); ?></div>

		<?php ActiveForm::end(); ?>
	</div>
	<!---->
</div>