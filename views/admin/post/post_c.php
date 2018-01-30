<?php
$this->title = 'Post';
Yii::$app->params['page_small_title'] = 'Create post';
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
$list_parent = [];

foreach ($theCategoryHas as $t){
	$list_parent[]= ['id'=>$t['id'],'name'=> str_repeat('--', $t['depth']). ' ' .$t['category_detail']['name']];
}


?>

<div class="grid-form">
	<div class="grid-form1">
		<h3 id="forms-example" class="">Create Post</h3>
		<?php $form = ActiveForm::begin();?>
			<div class="form-group">
				<?=$form->field($thePostForm, 'cate_id')->dropDownList(ArrayHelper::map($list_parent, 'id', 'name')); ?>
			</div>
			<div class="form-group">				
				<?= $form->field($thePostForm, 'avatar')
                                ->widget( FileInput::classname(), [ 
                                                    'options' => ['accept' => 'image/*'],
                                                    'pluginOptions' => [
                                                        'showUpload' => false,
                                                        'showCancel' => false,
                                                        'showRemove' => false,
                                                        'initialPreview'=>[															
                                                            $thePostForm->avatar,                                                            
                                                        ],
                                                        'initialPreviewAsData'=>true,
                                                        'initialCaption'=>$thePostForm->avatar,
                                                        'initialPreviewConfig' => [                                                        
                                                            ['caption' => $thePostForm->avatar, 'size' => '1287883'],
                                                        ],
                                                        'overwriteInitial'=>true,
                                                        'maxFileSize'=>2800
                                                    ] ,
                                                    
                                        ]); 
        		?>
			</div>						
			<div class="form-group">
				<?=$form->field($thePostForm, 'name')?>
			</div>
			<div class="form-group">
				<?=$form->field($thePostForm, 'description')->textArea(['rows'=>5])?>
			</div>
			<div class="form-group">
				<?=$form->field($thePostForm, 'content')->textArea(['rows'=>20])?>
			</div>
			<div class="form-group">
				<?=$form->field($thePostForm, 'tag')?>
			</div>
			<div class="form-group">
				<?=$form->field($thePostForm, 'seo_title')?>
			</div>
			<div class="form-group">
				<?=$form->field($thePostForm, 'seo_description')->textArea(['rows'=>5])?>
			</div>
			<br/>
			<div class="text-right"><?= Html::submitButton('submit', ['class' => 'btn btn-default']); ?></div>

		<?php ActiveForm::end(); ?>
	</div>
	<!---->
</div>

<?php
$js = <<<'JS'
    $('#postform-content,#postform-description').ckeditor({
        allowedContent: 'p sub sup strong em s a i u ul ol li blockquote; img(*)[*]{*};',
        entities: false,
        entities_greek: false,
        entities_latin: false,
        uiColor: '#ffffff',
        height:400,
        contentsCss: '/assets/css/style_ckeditor.css'
    });
JS;

$this->registerJs ( $js );

$this->registerJsFile ( 'https://cdn.ckeditor.com/4.7.3/basic/ckeditor.js', [
        'depends' => 'yii\web\JqueryAsset'
] );
$this->registerJsFile ( 'https://cdn.ckeditor.com/4.7.3/basic/adapters/jquery.js', [
        'depends' => 'yii\web\JqueryAsset'
] );