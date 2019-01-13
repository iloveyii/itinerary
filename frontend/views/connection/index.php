<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Connection';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index box">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Connection', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'from_vertex_id',
            'to_vertex_id',
            'distance',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
