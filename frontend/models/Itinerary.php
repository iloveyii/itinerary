<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\Query;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "itinerary".
 *
 * @property integer $id
 * @property integer $from_vertex_id
 * @property integer $to_vertex_id
 * @property string $updated_at
 * @property string $created_at
 *
 * @property ItineraryConnection[] $itineraryConnections
 */
class Itinerary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'itinerary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_vertex_id', 'to_vertex_id'], 'required'],
            [['from_vertex_id', 'to_vertex_id'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from_vertex_id' => 'From Vertex ID',
            'to_vertex_id' => 'To Vertex ID',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItineraryConnections()
    {
        return $this->hasMany(ItineraryConnection::className(), ['itinerary_id' => 'id']);
    }

    public static function listItinerary()
    {
        // return ArrayHelper::map(Itinerary::find()->select(['id'])->all(), 'id', 'id');
        // $its = Itinerary::find()->joinWith('vertex')->all();

        $query = (new Query())
            ->select(['itinerary.id, itinerary.from_vertex_id, itinerary.to_vertex_id,
             v1.name AS from_name, v2.name AS to_name, 
             CONCAT(v1.name, " - ",  v2.name) AS it_name
             '])
            ->from('itinerary')
            ->innerJoin('vertex v1', 'itinerary.from_vertex_id = v1.id')
            ->innerJoin('vertex v2', 'itinerary.to_vertex_id = v2.id')
            ->orderBy('itinerary.id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $models = $dataProvider->getModels();

        return ArrayHelper::map($models, 'id', 'it_name');
    }

    public static function getItname($id) {

        $model = Itinerary::findOne($id);

        if(is_null($model)) {
            return null;
        }

        $from = Vertex::findOne(['id'=>$model->from_vertex_id]);
        $to = Vertex::findOne(['id'=>$model->to_vertex_id]);

        if($from && $to) {
            return sprintf("%s - %s", $from->name, $to->name);
        }

        return 'NA';
    }
}
