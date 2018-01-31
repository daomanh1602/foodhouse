<?php
$this->title = Yii::t('appuser', 'Update Slide');
Yii::$app->params['page_small_title'] = Yii::t('appuser', 'Update Slide');

use app\models\admin\Category;

// var_dump($model);exit();

?>

	<div class="grid-system">
		<div class="grid-hor">
			<h3 id="grid-example-basic"><?php echo $this->title; ?></h3>
		</div>
		<hr>
		
		<?= $this->render('_form', [
       		'model' => $model,
			'theForm' => $theForm,
			'type_slide' => $type_slide,
    	]) ?>
	</div>
	<!---->
