<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\admin\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Testtbl */
/* @var $form yii\widgets\ActiveForm */

?>



    <?php $form = ActiveForm::begin(); ?>
        <div class="col-md-12">
            <?= $form->field($theForm, 'name')->textInput(['maxlength' => true]) ?>

            <div class="form-group ">
                <?= Html::label('Parent', 'parent',['class'=>'control-label'])?>
                <?= Html::dropDownList(
                    'Category[parentId]',
                    $model->parentId,
                    Category::getTree($model->id),
                    ['prompt'=>	'Select parent ','class'=>'form-control-group']	
                )?>
            </div>

            <?php $form->field($model, 'position')->textInput(['type'=>'number']) ?>

            <?= $form->field($theForm, 'description')->textarea(['rows'=>5,'maxlength' => true]) ?>
            
            <?= $form->field($theForm, 'content')->textArea(['rows'=>15,'maxlength' => true])?>
            
            <?= $form->field($theForm, 'seo_title')->textInput(['maxlength' => true])?>
            
            <?= $form->field($theForm, 'seo_description')->textArea(['rows'=>5,'maxlength' => true])?>
        
        </div>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create new') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    
    <?php ActiveForm::end(); ?>



<?php
$js = <<<'JS'
    $('#categoryform-content,#categoryform-description').ckeditor({
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