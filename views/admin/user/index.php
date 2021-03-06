<?php
$this->title = Yii::t('app', 'Account');

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
			<p class=""><?php echo Yii::t('app', 'account');?></p>
		</div>
		<!---->
		
		<!-- SEARCH BOX -->
		<div class="col-md-12">		
			<div class="col-md-4 compose" style="float: right;">
				<form action="#" method="GET">
	                <div class="input-group input-group-in">
	                    <input type="text" name="search" class="form-control2 input-search" placeholder="Search...">
	                    <span class="input-group-btn">                        
	                        <button class="btn btn-search btn-success" type="submit" ><i class="fa fa-search"></i></button>
	                    </span>
	                </div><!-- Input Group -->
	            </form>
	        </div>
	        <div>
	        	<a href="/admin/user/c" class=" btn btn-primary"><?php echo Yii::t('app', 'Create new')?> <i class="fa fa-pencil" aria-hidden="true"></i></a>	        	
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
							<th style="color: red; width: 20%"><?php echo Yii::t('app', 'f_name')?></th>
							<th style="color: red; width: 20%"><?php echo Yii::t('app', 'l_name')?></th>
							<th style="color: red; width: 20%"><?php echo Yii::t('app', 'u_name')?></th>							
							<th style="color: red; width: 20%">Email</th>													
							<th style="color: red; width: 10%"><?= Yii::t('app', 'Action')  ?></th>									
						</tr>
					</thead>
					<tbody>
					<?php foreach ($the_user as $v_user){?>
						<tr>
							<td><?php echo $v_user['id']?></td>
							<td><?php echo $v_user['f_name']?></td>
							<td><?php echo $v_user['l_name']?></td>
							<td><?php echo $v_user['username']?></td>
							<td><?php echo $v_user['emails']?></td>
							<td><a href="/admin/user/u?id=<?php echo $v_user['id'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> | <a href="/admin/user/d?id=<?php echo $v_user['id'];?>"><i class="fa fa-trash-o fa-2" aria-hidden="true"></i></a> </td>
						</tr>						
					</tbody>
					<?php }?>					
				</table>
			</div>
			<?php if($pages->totalCount > $pages->pageSize) { ?>
			<div class="text-right" style="">
			<?= LinkPager::widget([
					'pagination' => $pages,
					'firstPageLabel'=>'<<',
					'prevPageLabel'=>'<',
					'nextPageLabel'=>'>',
					'lastPageLabel'=>'>>',
				]); ?>
			</div>
			<?php } // if pages ?>
			<!-- /.box-body -->
		</div>
		<!-- END TABLE -->
	
	<!---->

</div>
<!--//grid-->