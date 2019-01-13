<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Connection */

$this->title = 'Update Connection: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Connection', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="category-update box">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'listVertex' => $listVertex
    ]) ?>

</div>
