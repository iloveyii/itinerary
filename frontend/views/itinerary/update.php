<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Itinerary */

$this->title = 'Update Itinerary: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Itinerary', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="category-update box">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
