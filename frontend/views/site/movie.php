<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use tuyakhov\youtube\EmbedWidget;

$this->title = 'Watch online ' . $movie->title;
$this->params['breadcrumbs'][] = ['label'=>'Movies', 'url'=>['site/movies']];
$this->params['breadcrumbs'][] = $movie->title;
?>

<div class="col-md-3 col-sm-6" style="margin-right: 30px;">
    <div class="row">
        <span style="color:#fff;padding:5px;position:absolute;top:50px;"><?= Html::encode($movie->title) ?></span>
        <a href="<?=$movie->poster?>"> <img class="img-rounded" style="width:100%; height: 395px;"  src="<?=$movie->poster?>" alt=""> </a>
    </div>
    <div class="row">
        <a href="magnet:<?= Html::decode($movie->magnet_link)?>">Download</a>
    </div>
</div>

<?php
echo EmbedWidget::widget([
    'code' => $movie->youtube_id,
    'playerParameters' => [
        'controls' => 2,
        'autoplay' => 0
    ],
    'iframeOptions' => [
        'width' => '600',
        'height' => '450'
    ]
]);

?>