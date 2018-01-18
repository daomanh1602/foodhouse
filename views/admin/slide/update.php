<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Testtbl */

$this->title = 'Update Testtbl: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Testtbls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="testtbl-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'theForm' => $theForm
    ]) ?>

</div>
