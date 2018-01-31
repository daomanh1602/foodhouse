<?php
$this->title = 'Menu';
Yii::$app->params['page_small_title'] = 'Update menu';

use app\models\admin\Menu;

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
