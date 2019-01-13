<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        echo $form->field($model, 'from_vertex_id')->widget(Select2::classname(), [
            'data' => $listVertex,
            'language' => 'en',
            'options' => ['placeholder' => 'Select a Vertex'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?php
    echo $form->field($model, 'to_vertex_id')->widget(Select2::classname(), [
        'data' => $listVertex,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a Vertex'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Find' : 'Search', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
