<?php
$this->title = 'Menu';
Yii::$app->params['page_small_title'] = 'Create Menu';

use app\models\admin\Menu;


$parent = [];
foreach ($theParent as $v){
	$parent[] = [ 'id'=> $v['id'], 'name' => str_repeat('--', $v['depth']). ' ' . $v['menu_detail']['name']];	
}


//  var_dump($parent);exit();

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
