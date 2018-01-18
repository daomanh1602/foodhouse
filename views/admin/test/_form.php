<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\admin\Testcategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="testcategory-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<?= $form->field($model, 'parent_id')->textInput() ?>
	
   
    <?= $form->field($model, 'lvl')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'depth')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
