<?php
namespace frontend\controllers;

use app\models\Itinerary;
use Yii;
use app\models\Ticket;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class TicketController extends \yii\web\Controller
{
    /**
     * Lists all Ticket models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Ticket::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ticket model.
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
     * Creates a new Ticket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ticket();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'listItinerary' => Itinerary::listItinerary()
        ]);
    }

    /**
     * Updates an existing Ticket model.
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
            'listItinerary' => Itinerary::listItinerary()
        ]);
    }

    /**
     * Deletes an existing Ticket model.
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
     * Finds the Ticket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ticket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ticket::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionApiindex()
    {

        $query = (new Query())
            ->select(['ticket.id AS id', 'ticket.price', 'ticket.quantity', 'itinerary.from_vertex_id, itinerary.to_vertex_id,
             v1.name AS from_name, v2.name AS to_name, 
             CONCAT(v1.name, " - ",  v2.name) AS it_name
             '])
            ->from('ticket')
            ->innerJoin('itinerary', 'ticket.itinerary_id = itinerary.id')
            ->innerJoin('vertex v1', 'itinerary.from_vertex_id = v1.id')
            ->innerJoin('vertex v2', 'itinerary.to_vertex_id = v2.id')
            ->orderBy('itinerary.id');


        $dataProvider = new ActiveDataProvider([
            'query' => $query, // Ticket::find(),
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
        $model = new Ticket();

        if( ! empty($post) ) {
            $model->price = $post['price'];
            $model->quantity = $post['quantity'];
            $model->itinerary_id = $post['itinerary_id'];
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
            $model->price = $post['price'];
            $model->quantity = $post['quantity'];
        }

        if ($model->validate() && $model->save()) {
            $model->status = 'success';
            echo Json::encode($model);
            return;
        }

        $model->status = $model->getErrors();
        echo Json::encode($model);
    }

    public function actionApidelete($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $this->findModel($id)->delete();

        echo Json::encode(['status'=>'success']);
    }

    public function actionClient()
    {
        $model = new Ticket();

        return $this->render('client', [
            'model'=>$model,
            'listItinerary' => Itinerary::listItinerary()
        ]);
    }


}
