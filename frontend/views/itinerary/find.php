<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Itinerary */

$this->title = 'Find Itinerary';
$this->params['breadcrumbs'][] = ['label' => 'Itinerary', 'url' => ['find']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create box">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_find', [
        'model' => $model,
        'listVertex' => $listVertex
    ]) ?>

</div>
