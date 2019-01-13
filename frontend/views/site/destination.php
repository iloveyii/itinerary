<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\Carousel;

$this->title = 'Destinations ';
$this->params['breadcrumbs'][] = ['label'=>'Movies', 'url'=>['site/movies']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
    $this->registerCss('
        .newspaper {
            -webkit-columns: 100px 2; /* Chrome, Safari, Opera */
            -moz-columns: 100px 2; /* Firefox */
            columns: 100px 2;
        }
        
        .item {
            display: none;
            position: relative;
            .transition(.6s ease-in-out left);
        }
    ');

    $this->registerJs("
        $(document).ready(function() {      
           $('.carousel').carousel({
                pause: false,
                interval: 700
            });
        });
        
        $('.carousel').on({
          mouseenter: function () {
            $(this).carousel({
                pause: false,
                interval: 1000
            });
            console.log(1);
          },
          mouseout: function () {
            $(this).carousel('pause');
            console.log(2);
          }
        });
        
    ");
    $c = 1;
?>
<div class="newspaper">
    <?php foreach($trips as $trip): ?>
        <div class="list-group">
            <a id="destination" href="<?=$trip->link?>">
                <?php
                $csvImages = '';
                $aImages = [];
                $aImages[] = [
                    'content' => "<img class='img-thumbnail' style='height:420px; width:100%' src='{$trip->image_link}'/>",
                    'caption' => "<h4>{$trip->title}</h4><p>{$trip->description}</p>",
                    'options' => [],
                ];
                if(isset($trip->additional_image_link)) {
                    $images = explode(',', $trip->additional_image_link);

                    foreach($images as $image) {
                        $aImages[] = [
                            'content' => "<img class='img-thumbnail' style='height:420px; width:100%' src='{$image}'/>",
                            'caption' => "<h4>{$trip->title}</h4><p>{$trip->description}</p>",
                            'options' => [],
                        ];
                    }
                }

                echo Carousel::widget([
                    'items' => $aImages,
                    'controls'=>count($aImages) > 1 ? false : false,
                    'showIndicators'=>true,
                ]);
                ?>
            </a>
        </div>
        <?php $c++; if($c > 20) break;?>
    <?php endforeach; ?>
</div>
