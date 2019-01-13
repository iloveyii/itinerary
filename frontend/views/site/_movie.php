<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="col-md-3 col-sm-6">
    <div class="panel panel-default">
        <div class="panel-body" style="padding: 0">
            <span style="color:#fff;padding:5px;position:absolute;top:10px;"><b><?= Html::encode($movie->title)?></b></span>
            <a href="<?=Url::to(['movie', 'id'=>$movie->id])?>"> <img class="img-responsive" style="width:100%; height:340px;"  src="<?=$movie->poster?>" alt=""> </a>
        </div>

        <div class="panel-footer" style="line-height: 30px;">
            <span class="glyphicon glyphicon-star pull-left"> 8.3  </span>&nbsp;
            <span class="glyphicon glyphicon-eye-open pull-right"> 8k  </span>&nbsp;<br>
        </div>
    </div>
</div>
<br />
