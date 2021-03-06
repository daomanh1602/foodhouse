<?php
$this->title = Yii::t('app', 'Slide');

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
$list_id = '';
$list_use = '';
foreach($theSlide as $v){
    if($v['use_slide'] == 1){
        $list_use .= $v['id'].',';
    }
    $list_id .= $v['id'].',';
}
$list_id = rtrim($list_id, ',');
?>

<!--grid-->
<div class="grid-system">
		<!---->	
		<div class="grid-hor">
			<h3 id="grid-example-basic"><?= Yii::t('app', 'list') .' '. $this->title ?></h3>
			<p class=""><?= Yii::t('app', 'List Slide '); ?> </p>
		</div>
		<!---->
		
		<!-- SEARCH BOX -->
		<div class="col-md-12">		
			<div class="col-md-6 compose" style="float: right;">
				<form action="#" method="GET">
	               
					<div class="col-md-6 ">
						<?= Html::dropDownList(
							'type_s',
							'',
							ArrayHelper::map($type_slide, 'id', 'name_1'),
							['prompt'=>	'Select parent ','class'=>'form-control2']	
						)?>
					</div>
					<div class="col-md-6 ">
						<div class="input-group input-group-in">
							<?= Html::textInput('g_name', $name, ['class'=>'form-control2 input-search', 'autocomplete'=>'off', 'placeholder'=>'Title']) ?>

							<span class="input-group-btn">                        
								<button class="btn btn-search btn-success" type="submit" ><i class="fa fa-search"></i></button>
							</span>
						</div><!-- Input Group -->				
					</div>
			
	            </form>
	        </div>
			
	        <div>
	        	<a href="/admin/slide/c" class=" btn btn-primary"><?php echo Yii::t('app', 'Create new')?> <i class="fa fa-pencil" aria-hidden="true"></i></a>	 
				<a href="" class="btn btn-primary hide" id="update_use"><?php echo Yii::t('app', 'Update')?></a>       	
                <?= Html::textInput('id_edit', $list_id, ['class'=>'form-control hide change_id']) ?>                   
	        </div>
		</div>		
		<!-- END SEARCH BOX -->
		
		<!-- TABLE -->
		<div class="box">			
			<!-- /.box-header -->
            <?= Html::textInput('id_check', $list_use , ['class'=>'form-control hide id_check']) ?>             
			<div class="box-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th style="color: red; width: 10%">ID</th>
							<th style="color: red; width: 15%"><?= Yii::t('app', 'Title'); ?></th>
							<th style="color: red; width: 10%"><?= Yii::t('app', 'r_type'); ?></th>
							<th style="color: red; width: 10%"><?= Yii::t('app', 'Move'); ?></th>
							<th style="color: red; width: 10%"><?= Yii::t('app', 'Use'); ?></th>
							<th style="color: red; width: 15%"><?= Yii::t('app', 'Created at'); ?></th>
							<th style="color: red; width: 20%"><?= Yii::t('app', 'Created by'); ?></th>														
							<th style="color: red; width: 10%"><?= Yii::t('app', 'Action'); ?></th>							
						</tr>
					</thead>
					<tbody>
					<?php foreach ($theSlide as $v){?>
						<tr class="tr-v" data-id="<?= $v['id'] ?>" id="h_<?= $v['id'] ?>">
							<td><?= $v['id']?></td>												
							<td><?= str_repeat('--', $v['depth']). ' ' . $v['slide_detail']['name'] ?></td>			
							<td><?= $v['slide_type']['name_1'] ?></td>						
							<td>
      							<a title="<?=Yii::t('app', 'move')?>" class="text-muted" href="/admin/slide/moveup?id=<?=$v['id']?>"><i class="fa fa-arrow-up "></i></a> | 
      							<a title="<?=Yii::t('app', 'move')?>" class="text-muted" href="/admin/slide/movedown?id=<?=$v['id']?>"><i class="fa fa-arrow-down"></i></a>
     						</td>								
							<td>
								<input type="checkbox" name="check_box" value="<?= $v['use_slide']?>" class="check_id" id="check_id_<?= $v['id'] ?>" <?= $v['use_slide'] == '1' ? 'checked' : '' ?> >				
							</td> 
							<td><?= date("Y-m-d", $v['created_at']); ?></td>																	
							<td><?= $v['user_created']['username']?></td>																						
							<td><a href="/admin/slide/u?id=<?= $v['id'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> | <a href="/admin/slide/d?id=<?= $v['id'];?>"><i class="fa fa-trash-o fa-2" aria-hidden="true"></i></a> </td>
						</tr>						
					</tbody>
					<?php }?>					
				</table>
			</div>
			<?php if ($pages->totalCount > $pages->pageSize) { ?>
			<div class="text-right" style="">
			<?= LinkPager::widget([
					'pagination' => $pages,
					'firstPageLabel'=>'<<',
					'prevPageLabel'=>'<',
					'nextPageLabel'=>'>',
					'lastPageLabel'=>'>>',
				]) ?>
			</div>
			<?php } // if pages ?>
			<!-- /.box-body -->
		</div>
		<!-- END TABLE -->
	
	<!---->

</div>
<!--//grid-->
<?
$js = <<<TXT
var list_id = $('.change_id').val();

$('#example1').on('click','input.check_id', function(){
    var tr = $(this).closest('tr.tr-v');
    var id = tr.data('id');

    var	id_check = $('.id_check').val();	

    if(document.getElementById('check_id_'+id).checked) {
        id_check = id_check + id + ',';
        $('.id_check').val(id_check);	 
    } else {
        id_check= id_check.replace(id+',', "")        
        $('.id_check').val(id_check);
    }

    $('#update_use').removeClass("hide");
    
});

$('#update_use').on('click', function(){
 
    var list_id = $('.change_id').val();
    var id_check = $('.id_check').val();	

    $.ajax({
        method: "POST",
        url: '?action=update_use',
        data: { list_id :list_id , id_check : id_check }
    })
    .done(function( ) {               
        console.log('done');
    })
    .fail(function(){
        alert( "Error saving data" );
    })
    
});



TXT;

$this->registerJs($js);