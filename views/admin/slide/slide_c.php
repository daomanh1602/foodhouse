<?php
$this->title = 'Slide';
Yii::$app->params['page_small_title'] = 'Create Slide';

?>

<div class="grid-form">
	<div class="grid-form1">
		<h3 id="forms-example" class="">Create Slide</h3>
		
		<?= $this->render('_form', [
       		'model' => $model,
			'theForm' => $theForm,
    	]) ?>
	</div>
	<!---->
</div>