<?php

namespace frontend\controllers;

use app\models\Vertex;
use Doctrine\OrientDB\Graph\Graph;
use Yii;
use app\models\Itinerary;
use app\models\Client;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use Doctrine\OrientDB\Graph\Algorithm\Dijkstra;
use Doctrine\OrientDB\Graph\Vertex AS V;

/**
 * ItineraryController implements the CRUD actions for Itinerary model.
 */
class ItineraryController extends Controller
{
    private $vertices;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Itinerary models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' =>  Itinerary::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Itinerary model.
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
     * Creates a new Itinerary model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Itinerary();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'listVertex' => Vertex::listVertex()
        ]);
    }

    public function actionFind()
    {
        $model = new Itinerary();

        if ($model->load(Yii::$app->request->post())) {
            // return $this->redirect(['view', 'id' => $model->id]);
            $from = Vertex::findOne($model->from_vertex_id);
            $to = Vertex::findOne($model->to_vertex_id);

            // # 1 createVerticesAndConnections
            $graph = $this->createGraph();
            // # 2 Use Dijktras algo to find SPF
            $this->findItinerary($graph, $from->iata, $to->iata);
        }

        return $this->render('find', [
            'model' => $model,
            'listVertex' => Vertex::listVertex()
        ]);
    }

    private function createGraph()
    {
        $graph = new Graph();
        $vertices = Vertex::find()->with('connections')->all();

        foreach ($vertices as $vertex) {
            if( ! isset($oVertices[$vertex->iata])) {
                $oVertices[$vertex->iata] = new V($vertex->iata);
                $graph->add($oVertices[$vertex->iata]);
            }

            foreach ($vertex->connections as $connection) {
                $vertexConnected = Vertex::findOne($connection->to_vertex_id);
                if( ! isset($oVertices[$vertexConnected->iata])) {
                    $oVertices[$vertexConnected->iata] = new V($vertexConnected->iata);
                    $graph->add($oVertices[$vertexConnected->iata]);
                }

                $oVertices[$vertex->iata]->connect( $oVertices[$vertexConnected->iata], $connection->distance );
            }
        }

        $this->vertices = $oVertices;

        return $graph;
    }

    private function findItinerary($graph, $from, $to)
    {
        $d = new Dijkstra($graph);
        $d->setStartingVertex($this->vertices[$from]);
        $d->setEndingVertex($this->vertices[$to]);

        echo $d->getLiteralShortestPath();
    }

    /**
     * Updates an existing Itinerary model.
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
     * Deletes an existing Itinerary model.
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
     * Finds the Itinerary model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Itinerary the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Itinerary::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionApiindex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Itinerary::find(),
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
        $model = new Itinerary();

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
