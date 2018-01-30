<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\admin\Slide;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Testtbl */
/* @var $form yii\widgets\ActiveForm */
$list_type = [
	'0' => 'Hoat hinh',
	'1' => 'Ngay le',
];
$list_check = [
    '0' => 'Yes',
	'1' => 'No',
];

// var_dump($type_slide);exit();

?>

<div class="testtbl-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'enableClientScript' => false]) ?>

	<div class="form-group">               
        <?= $form->field($theForm, 'avatar')
                                ->widget( FileInput::classname(), [ 
                                                    'options' => ['accept' => 'image/*'],
                                                    'pluginOptions' => [
                                                        'showUpload' => false,
                                                        'showCancel' => false,
                                                        'showRemove' => false,
                                                        'initialPreview'=>[
                                                            $theForm->avatar,                                                            
                                                        ],
                                                        'initialPreviewAsData'=>true,
                                                        'initialCaption'=>$theForm->avatar,
                                                        'initialPreviewConfig' => [                                                        
                                                            ['caption' => $theForm->avatar, 'size' => '1287883'],
                                                        ],
                                                        'overwriteInitial'=>true,
                                                        'maxFileSize'=>2800
                                                    ] ,
                                                    
                                        ]); 
        ?>
	</div>

	<div class="form-group">			
        <?= $form->field($theForm, 'name')->textInput(['maxlength' => true]) ?>
    </div>

    <?= $form->field($theForm, 'use' , ['enableClientValidation'=>false])->checkbox() ?>

    <div class="form-group">
    	<?=$form->field($theForm, 'type')->dropDownList(ArrayHelper::map($type_slide, 'id', 'name')); ?>
        
    </div>

    <div class="form-group">			
	    <?= $form->field($theForm, 'description')->textarea(['rows'=>5,'maxlength' => true]) ?>
	</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js = <<<'JS'
    $('#categoryform-description').ckeditor({
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