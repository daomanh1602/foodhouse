<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\admin\Slide;
use kartik\widgets\FileInput;

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
]
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
                                                        'initialPreview'=>[
                                                            $theForm->avatar,                                                            
                                                        ],
                                                        'initialPreviewAsData'=>true,
                                                        'initialCaption'=>"The Moon and the Earth",
                                                        'initialPreviewConfig' => [                                                        
                                                            ['caption' => $theForm->avatar, 'size' => '1287883'],
                                                        ],
                                                        'overwriteInitial'=>false,
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
        <?=$form->field($theForm, 'type')->dropDownList($list_type); ?>
    </div>

    <div class="form-group">			
	    <?= $form->field($theForm, 'description')->textarea(['rows'=>5,'maxlength' => true]) ?>
	</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

