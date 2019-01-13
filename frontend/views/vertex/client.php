<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vertex';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('@web/js/lib/underscore-min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/js/lib/backbone-min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/js/main.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="box">

    <div class="row">
        <div class="col-md-12">
            <h2>Vertex</h2>
            <br />
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <form class="form-group" action="/api/vertex" method="post">
                <div class="form-group">
                    <label class="form-control-label" for="iata">Iata</label>
                    <input type="text" placeholder="Type iata of the vertex" class="form-control is-valid" id="iata">
                </div>
                <div class="form-group">
                    <label class="form-control-label" for="name">Name</label>
                    <input type="text" placeholder="Type name of the vertex" class="form-control is-valid" id="name">
                </div>

                <br />
                <button type="submit" class="btn btn-outline-secondary">Add</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <br />
            <table class="table table-hover" id="songs-index-table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>iata</th>
                    <th>name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="vertex-index">

                </tbody>
            </table>
        </div>
    </div>

</div>

<script type="text/template" class="vertex-item-template">
    <td><span class="id"><%=id%></span></td>
    <td><span class="iata"><%=iata%></span></td>
    <td><span class="name"><%=name%></span></td>
    <td nowrap style="width:240px;">
        <span class="controls">
            <button class="btn btn-warning btn-sm item-edit">Edit</button>
            <button class="btn btn-danger btn-sm item-delete">Delete</button>

            <button style="display: none;" class="btn btn-primary btn-sm item-update">Update</button>
            <button style="display: none;" class="btn btn-default btn-sm item-cancel">Cancel</button>
        </span>
    </td>
</script>