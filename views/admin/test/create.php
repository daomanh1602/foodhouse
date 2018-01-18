<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\admin\Testcategory */

$this->title = 'Create Testcategory';
$this->params['breadcrumbs'][] = ['label' => 'Testcategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testcategory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
