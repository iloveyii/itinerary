<?php

namespace frontend\controllers;

use app\models\Connection;
use app\models\Vertex;
use Yii;
use app\models\Itinerary;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class ConnectionController extends \yii\web\Controller
{
    /**
     * Lists all Connection models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' =>  Connection::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Connection model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Connection model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Connection();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'listVertex' => Vertex::listVertex()
        ]);
    }

    /**
     * Updates an existing Connection model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'listVertex' => Vertex::listVertex()
        ]);
    }

    /**
     * Deletes an existing Connection model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Connection model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Connection the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Connection::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionApiindex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Connection::find(),
        ]);

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        echo Json::encode($dataProvider->getModels());
    }

    public function actionApiview($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = $this->findModel($id);

        echo Json::encode($model);
    }

    public function actionApicreate()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new Connection();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo Json::encode($model);
            return;
        }

        echo Json::encode($model->getErrors());
    }

    public function actionApiupdate($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo Json::encode($model);
            return;
        }

        echo Json::encode($model->getErrors());
    }


}
