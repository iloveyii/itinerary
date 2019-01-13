<?php

namespace frontend\controllers;

use app\models\Vertex;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

class VertexController extends \yii\web\Controller
{

    /**
     * Lists all Challenge models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Vertex::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Challenge model.
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
     * Creates a new Vertex model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vertex();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Vertex model.
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
        ]);
    }

    /**
     * Deletes an existing Vertex model.
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
     * Finds the Vertex model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vertex the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vertex::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionApiindex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Vertex::find(),
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

    private function getInputData()
    {
        $file_handle = fopen('php://input', 'r');
        $input = '';

        while(!feof($file_handle)){
            $s = fread($file_handle, 64);
            $input .= $s;
        }
        fclose($file_handle);

        if(!empty($input)) $_POST = array_merge($_POST, (array)json_decode($input));

        return $_POST;
    }
    public function actionApicreate()
    {
        $post = $this->getInputData();
        $model = new Vertex();

        if( ! empty($post) ) {
            $model->iata = $post['iata'];
            $model->name = $post['name'];
        }

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ($model->validate() && $model->save()) {
            echo Json::encode($_POST);
            return;
        }

        echo Json::encode($model->getErrors());
    }

    public function actionApiupdate($id)
    {
        $post = $this->getInputData();

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = $this->findModel($id);
        if( ! empty($post) ) {
            $model->iata = $post['iata'];
            $model->name = $post['name'];
        }

        if ($model->validate() && $model->save()) {
            $model->status = 'success';
            echo Json::encode($model);
            return;
        }

        $model->status = $model->getErrors();
        echo Json::encode($model->getErrors());
    }

    public function actionApidelete($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $this->findModel($id)->delete();

        echo Json::encode(['status'=>'success']);
    }

    public function actionClient()
    {
        return $this->render('client');
    }
}
