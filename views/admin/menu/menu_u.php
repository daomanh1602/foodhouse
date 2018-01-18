<?php
$this->title = 'Menu';
Yii::$app->params['page_small_title'] = 'Update menu';

use app\models\admin\Menu;

?>

<div class="grid-form">
	<div class="grid-form1">
		<h3 id="forms-example" class="">Updadte Menu</h3>
		
		<?= $this->render('_form', [
       		'model' => $model,
			'theForm' => $theForm,
    	]) ?>
	</div>
	<!---->
</div>