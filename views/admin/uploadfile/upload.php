<?php
use yii\widgets\ActiveForm;
use  kartik\widgets\FileInput;
?>

<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data'], 'enableClientScript' => false]) ?>


    <?= $form->field($model, 'avatar')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*']]); ?>
    <button>Submit</button>

<?php ActiveForm::end() ?>
<!--uploadfile-avatar-->
