<?php
$this->title = 'Category';
Yii::$app->params['page_small_title'] = 'Create category';

use app\models\admin\Category;

// var_dump($model);exit();

?>

<div class="grid-form">
	<div class="grid-form1">
		<h3 id="forms-example" class="">Updadte Category</h3>
		
		<?= $this->render('_form', [
       		'model' => $model,
			'theForm' => $theForm,
    	]) ?>
	</div>
	<!---->
</div>