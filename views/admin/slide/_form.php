<?php
// var_dump(DIR);exit();
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\admin\Slide;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Testtbl */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="testtbl-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'enableClientScript' => false]) ?>

    <div class="form-group hide">
        <!-- upload pic -->		
        <div id="files-list"></div>
        <p id="files-container">
            <a id="files-browse" href="javascript:;">Upload</a>
            <span id="files-console" class="text-danger"></span>
        </p>					
        <!-- UPLOAD PIC  -->
    </div> 

	<div class="form-group ">
        
        <?= $form->field($theForm, 'avatar')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*'],'pluginOptions' => ['showUpload' => false,'showCancel' => false,]]); ?>
	</div>
				
    <?= $form->field($theForm, 'name')->textInput(['maxlength' => true]) ?>


	<?= $form->field($theForm, 'description')->textarea(['rows'=>5,'maxlength' => true]) ?>
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?

$pluploadJs = <<<'TXT'
var uploader = new plupload.Uploader({
    runtimes: 'html5,flash,silverlight',
    container: document.getElementById('files-container'),    
    browse_button: 'files-browse',
    url: '/assets/plupload_2.1.9/upload.php',
    // url: '/upload/slide/',
    filters: {
        max_file_size : '25mb',
        prevent_duplicates: true,
        mime_types : [
            {title : "Image files", extensions : "jpg,gif,png"},
            {title : "Zip files", extensions : "zip"}
        ]
    },
    unique_names: true,
    init: {
        PostInit: function() {
            $('#files-list').empty();
        
            $('.btn').onclick = function() {
                uploader.start();
                return false;
            };
            			
        },

        FilesAdded: function(up, files) {
            plupload.each(files, function(file) {
				var file_type = file.type;
				var img = new o.Image();    

 				$('#files-list').append('<div id="' + file.id + '"><div id="img_' + file.id + '"></div><input type="hidden" name="fileid[]" value="'+file.id+'"><input type="hidden" name="filename[]" value="'+file.name+'"><ul id="' + file.id + '"></ul>+ '+ file.name + ' (' + plupload.formatSize(file.size) + ') <span class="text-info"></span></div>');

				if(file_type.indexOf("image") < 0){					
	                $('#img_'+file.id).append('<img src="/assets/img/no-image.png" style=" width: 60px; height: 60px; " />')	                
				}else{
					img.onload = function() {
	                    // create a thumb placeholder
	                    var li = document.createElement('li');
	                    li.id = this.uid;
	                    document.getElementById("img_"+file.id).appendChild(li);
	                        
	                    // embed the actual thumbnail
	                    this.embed(li.id, {
	                        width: 200,
	                        height: 160,
	                        crop: false
	                    });
	                };               				
					img.load(file.getSource());   
                    console.log(file.getSource());
				}				
            });         
        },

        FileUploaded: function(up, file, res) {
			/*
			$.post('/files/ajax', {name:file.name, filegroup:1, action:'create', size:file.size, id:file.id}, function(data){
				if (data.status == 'OK') {
					$('#' + file.id).remove();
					var html = '<tr id="file-' + data.id + '"><td><input type="hidden" name="file_id[]" value="' + data.id + '" />+ <a href="/files/r/'+data.id+'">' + file.name + '</a></td><td class="ta-r">' + data.sizeh + ' (<a rel="' + data.id + '" class="file-del" href="#delete">Delete</a>)</td></tr>';
					$('#table-filelist tr:first').after(html);
				} else {
					$('#' + file.id + " span").html(data.status);
				}
			}, 'json');
			*/
			$('#'+file.id+' span').empty();
			$('#'+file.id).append(' (<a class="files-file-remove" href="javascript:;" rel="">Remove</a>)');
		},

        UploadProgress: function(up, file) {
            $('#'+file.id+' span').html(' - Uploading ' + file.percent + '%');
        },

        Error: function(up, err) {
            $('#files-console').append("<br>Error" + err.code + ": " + err.message);
        },

        QueueChanged: function(up) {
            uploader.start();
        }
    }
});

uploader.init();


TXT;
$this->registerJsFile(DIR.'assets/plupload_2.1.9/js/plupload.full.min.js', ['depends'=>'yii\web\JqueryAsset']);

$this->registerJs($pluploadJs);