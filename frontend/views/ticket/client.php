<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ticket';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('@web/js/lib/underscore-min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/js/lib/backbone-min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/js/ticket.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="box">

    <div class="row">
        <div class="col-md-12">
            <h2><?= $this->title ?></h2>
            <br />
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">

            <?php $form = ActiveForm::begin(['action'=>'/api/ticket', 'method'=>'post']); ?>

            <?php
                echo $form->field($model, 'itinerary_id')->widget(Select2::classname(), [
                    'data' => $listItinerary,
                    'language' => 'en',
                    'options' => ['placeholder' => 'Select an Itinerary', 'id'=>'itinerary_id'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
            ?>
            <div class="form-group">
                <label class="form-control-label" for="quantity">Price</label>
                <input type="text" placeholder="Type price of the itinerary" class="form-control is-valid" id="price">
            </div>

            <div class="form-group">
                <label class="form-control-label" for="quantity">Quantity</label>
                <input type="text" placeholder="Type quantity of the itinerary" class="form-control is-valid" id="quantity">
            </div>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <br />
            <table class="table table-hover" id="songs-index-table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Itinerary</th>
                    <th>price</th>
                    <th>quantity</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="ticket-index">

                </tbody>
            </table>
        </div>
    </div>

</div>

<script type="text/template" class="ticket-item-template">
    <td><span class="id"><%=id%></span></td>
    <td><span class="price"><%=price%></span></td>
    <td><span class="it_name"><%=it_name%></span></td>
    <td><span class="quantity"><%=quantity%></span></td>
    <td nowrap style="width:240px;">
        <span class="controls">
            <button class="btn btn-warning btn-sm item-edit">Edit</button>
            <button class="btn btn-danger btn-sm item-delete">Delete</button>

            <button style="display: none;" class="btn btn-primary btn-sm item-update">Update</button>
            <button style="display: none;" class="btn btn-default btn-sm item-cancel">Cancel</button>
        </span>
    </td>
</script>