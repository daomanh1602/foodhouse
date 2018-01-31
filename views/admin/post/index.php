<?php
$this->title = Yii::t('app', 'Post');

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>

<!--grid-->
<div class="grid-system">
		<!---->	
		<div class="grid-hor">
			<h3 id="grid-example-basic"><?= Yii::t('app', 'list') .' '. $this->title ?></h3>
			<p class=""><?=Yii::t('app', 'Post')?></p>
		</div>
		<!---->
		
		<!-- SEARCH BOX -->
		<div class="col-md-12">		
			<div class="col-md-4 compose" style="float: right;">
				<form action="#" method="GET">
	                <div class="input-group input-group-in">
	            		<?= Html::textInput('g_name', $name, ['class'=>'form-control2 input-search', 'autocomplete'=>'off', 'placeholder'=>'Title']) ?>
	                    
	                    <span class="input-group-btn">                        
	                        <button class="btn btn-search btn-success" type="submit" ><i class="fa fa-search"></i></button>
	                    </span>
	                </div><!-- Input Group -->
	            </form>
	        </div>
	        <div>
	        	<a href="/admin/post/c" class=" btn btn-primary"><?php echo Yii::t('app', 'Create new')?><i class="fa fa-pencil" aria-hidden="true"></i></a>	        	
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
							<th style="color: red; width: 20%"><?= Yii::t('app', 'Title'); ?></th>
							<th style="color: red; width: 25%"><?= Yii::t('app', 'Category name'); ?></th>
							<th style="color: red; width: 20%"><?= Yii::t('app', 'Created at'); ?></th>
							<th style="color: red; width: 20%"><?= Yii::t('app', 'Created by'); ?></th>														
							<th style="color: red; width: 5%"><?= Yii::t('app', 'Action'); ?></th>							
						</tr>
					</thead>
					<tbody>
					<?php foreach ($the_post as $v){?>
						<tr>
							<td><?= $v['id']?></td>						
							<td><?= $v['post_detail']['name']?></td>
						
						<?php foreach ($v['category_detail'] as $v_cate_meta){?>
							<td><?= $v_cate_meta['name']?></td>
						<?php }?>
							<td><?= $v['created_at']?></td>																	
							<td><?= $v['user_created']['username']?></td>																						
							<td><a href="/admin/post/u?id=<?= $v['id'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> | <a href="/admin/post/d?id=<?= $v['id'];?>"><i class="fa fa-trash-o fa-2" aria-hidden="true"></i></a> </td>
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


