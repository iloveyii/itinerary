<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Ticket */

$this->title = 'Create Ticket';
$this->params['breadcrumbs'][] = ['label' => 'Ticket', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create box">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'listItinerary' => $listItinerary
    ]) ?>

</div>
