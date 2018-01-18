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

<div class="grid-form">
	<div class="grid-form1">
		<h3 id="forms-example" class="">Create Menu</h3>
		
		<?= $this->render('_form', [
       		'model' => $model,
			'theForm' => $theForm,
    	]) ?>
	</div>
	<!---->
</div>