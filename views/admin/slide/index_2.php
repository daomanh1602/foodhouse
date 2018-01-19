<?php
$this->title = 'Slide';

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>

<!--grid-->
<div class="grid-system">
		<!---->	
		<div class="grid-hor">
			<h3 id="grid-example-basic">List Slide on Website</h3>
			<p class="">Slide</p>
		</div>
		<!---->
		
		<!-- SEARCH BOX -->
		<div class="col-md-12">		
			<div class="col-md-4 compose" style="float: right;">
				<form action="#" method="GET">
	                <div class="input-group input-group-in">
	            		<?= Html::textInput('g_name', $name, ['class'=>'form-control2 input-search', 'autocomplete'=>'off', 'placeholder'=>'Title']) ?>
	                    
	                    <span class="input-group-btn">
	                        <button class="btn btn-success" type="button"><i class="fa fa-search"></i></button>
	                    </span>
	                </div><!-- Input Group -->
	            </form>
	        </div>
	        <div>
	        	<a href="/admin/slide/c" class=" btn btn-primary">Create new <i class="fa fa-pencil" aria-hidden="true"></i></a>	        	
	        </div>
		</div>		
		<!-- END SEARCH BOX -->
		
		<!-- TABLE -->
		<div class="box">			
			<!-- /.box-header -->
			<div class="box-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th style="color: red; width: 10%">ID</th>
							<th style="color: red; width: 25%">Title</th>
							<th style="color: red; width: 15%">Move</th>
							<th style="color: red; width: 20%">Created at</th>
							<th style="color: red; width: 20%">Created by</th>														
							<th style="color: red; width: 10%">Action</th>							
						</tr>
					</thead>
					<tbody>
					<?php foreach ($theSlide as $v){?>
						<tr>
							<td><?= $v['id']?></td>												
							<td><?= str_repeat('--', $v['depth']). ' ' . $v['slide_detail']['name'] ?></td>						
							<td>
      							<a title="<?=Yii::t('app', 'move')?>" class="text-muted" href="/admin/slide/moveup?id=<?=$v['id']?>"><i class="fa fa-arrow-up "></i></a> | 
      							<a title="<?=Yii::t('app', 'move')?>" class="text-muted" href="/admin/slide/movedown?id=<?=$v['id']?>"><i class="fa fa-arrow-down"></i></a>
     						</td>					
							<td><?= $v['created_at']?></td>																	
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
