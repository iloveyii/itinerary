<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Movies';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <div class="col-md-12">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <ul>
    <?php foreach ($movies as $movie) : ?>
        <?= $this->render('_movie', [
            'movie'=>$movie
        ]) ?>

    <?php endforeach; ?>
    </ul>

</div>
