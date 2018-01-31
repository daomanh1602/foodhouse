<?php
$this->title = 'update Category';
Yii::$app->params['page_small_title'] = 'Create category';

use app\models\admin\Category;

// var_dump($model);exit();

?>

	<div class="grid-system">
		<div class="grid-hor">
			<h3 id="grid-example-basic"><?php echo $this->title;?></h3>
		</div>
		<hr>
		
		<?= $this->render('_form', [
       		'model' => $model,
			'theForm' => $theForm,
    	]) ?>
	</div>
	<!---->
