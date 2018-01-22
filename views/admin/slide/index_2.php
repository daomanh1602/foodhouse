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
				<a href="" class=" btn btn-primary" id="update_use">Update</a>       	
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
							<th style="color: red; width: 15%">Title</th>
							<th style="color: red; width: 10%">Type</th>
							<th style="color: red; width: 10%">Move</th>
							<th style="color: red; width: 5%">Use</th>
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
							<td><?=  $v['type_slide'] ?></td>						
							<td>
      							<a title="<?=Yii::t('app', 'move')?>" class="text-muted" href="/admin/slide/moveup?id=<?=$v['id']?>"><i class="fa fa-arrow-up "></i></a> | 
      							<a title="<?=Yii::t('app', 'move')?>" class="text-muted" href="/admin/slide/movedown?id=<?=$v['id']?>"><i class="fa fa-arrow-down"></i></a>
     						</td>								
							<td>
								<input type="checkbox" name="check_box" value="<?= $v['id']?>" class="check_id" id="check_id_<?= $v['id'] ?>">				
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
<?
$js = <<<TXT

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

    
});


$('#tbl-cpt').on('click','a.update_text', function(){
    var tr = $(this).closest('tr.tr-v');
    var id = tr.data('id');
    $('.id').val(id);
    $('#add_'+id).removeClass('hide');
});

$('#tbl-cpt').on('click','a.sub', function(){
    var	id =  $('.id').val();
    var tr = $('tr.tr-v[data-id="'+id+'"]');
    
    var pax_update = $('#so_khach_'+id).val();
    var room_update = $('#so_phong_'+id).val();
    var type_update = $('#type_'+id).val();
    var type_text = $('#type_'+id+' :selected').text();

    if(type_update.length > 0){
        $.ajax({
            method: "POST",
            url: '?action=update',
            data: { dvtour_id : id , pax_update : pax_update , room_update : room_update , type_update : type_update }
        })
        .done(function( response ) {
            tr.find('.room_qty').html($('#so_phong_'+id).val());
            tr.find('.pax_qty').html($('#so_khach_'+id).val());        
            tr.find('.type_dv').html(type_text);
            $('.id').val(0);
            $('#add_'+id).addClass('hide');
        })
        .fail(function(){
            alert( "Error saving data" );
        })
    }else {
        alert( "Chon phan loai" );    
   }
});


$('#room_change').on('click', function(){
	var	day_id ='';	    

    var id_list_check = $('.id_check').val();	
     
    if(id_list_check.length > 0){
        day_id = $('.id_check').val();	
    }else{
        day_id = $('.change_id').val();
    }

    $.ajax({
        method: "POST",
        url: '?action=room',
        data: {day_id}
    })
     .done(function( response ) {

        var col = '4';
        $('table#tbl-cpt tbody tr').each(function(i){         
            $('table#tbl-cpt tbody tr td.room_qty:nth(' + i + ')').text($($(this).children()[col - 1]).text());    
            $('table#tbl-cpt tbody tr td.type_dv:nth(' + i + ')').text('phong ngu');           
            // $('table#tbl-cpt tbody tr td.room_qty:nth(' + i + ')').append( '<td>' +  + '</tr>');
        });
      
        console.log(response);
    })
    .fail(function(){
        alert( "Error saving data" );
    })
});

$('#sub_type').on('click', function(){
    
    var	day_id ='';	    

    var id_list_check = $('.id_check').val();	
    
    var type_value = $('.type_add').val();
    var type_text = $('.type_add :selected').text();

    if(type_value.length > 0){
        if(id_list_check.length > 0){
            day_id = $('.id_check').val();	
        }else{
            day_id = $('.change_id').val();
        }

        $.ajax({
            method: "POST",
            url: '?action=pax',
            data: { day_id :day_id , type_value : type_value }
        })
        .done(function( response ) {
            var col = '4';
            $('table#tbl-cpt tbody tr').each(function(i){         
                $('table#tbl-cpt tbody tr td.pax_qty:nth(' + i + ')').text($($(this).children()[col - 1]).text());         
                $('table#tbl-cpt tbody tr td.type_dv:nth(' + i + ')').text(type_text);     
            }); 
            $('.t').addClass('hide');
            
            console.log(response);
        })
        .fail(function(){
            alert( "Error saving data" );
        })
    }else{
        $('.t').removeClass('hide');
        alert('chọn phân loại');
    }
});

$('#pax_change').on('click', function(){
	var	day_id ='';	    

    var id_list_check = $('.id_check').val();	
    
    var type_value = $('.type_add').val();
    var type_text = $('.type_add :selected').text();

    if(type_value.length > 0){
        if(id_list_check.length > 0){
            day_id = $('.id_check').val();	
        }else{
            day_id = $('.change_id').val();
        }

        $.ajax({
            method: "POST",
            url: '?action=pax',
            data: { day_id :day_id , type_value : type_value }
        })
        .done(function( response ) {
            var col = '4';
            $('table#tbl-cpt tbody tr').each(function(i){         
                $('table#tbl-cpt tbody tr td.pax_qty:nth(' + i + ')').text($($(this).children()[col - 1]).text());         
                // $('table#tbl-cpt tbody tr td.pax_qty:nth(' + i + ')').append( '<td>' +  + '</tr>');
            }); 
            $('.t').addClass('hide');
            
            console.log(response);
        })
        .fail(function(){
            alert( "Error saving data" );
        })
    }else{
        $('.t').removeClass('hide');
        alert('chọn phân loại');
    }
});


TXT;

$this->registerJs($js);