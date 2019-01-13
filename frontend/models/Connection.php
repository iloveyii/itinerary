<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "connection".
 *
 * @property integer $id
 * @property integer $from_vertex_id
 * @property integer $to_vertex_id
 * @property integer $distance
 * @property string $updated_at
 * @property string $created_at
 *
 * @property Vertex $fromVertex
 * @property Vertex $toVertex
 * @property ItineraryConnection[] $itineraryConnections
 */
class Connection extends \yii\db\ActiveRecord
{
    public $distance;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'connection';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_vertex_id', 'to_vertex_id'], 'required'],
            [['from_vertex_id', 'to_vertex_id', 'distance'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['from_vertex_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vertex::className(), 'targetAttribute' => ['from_vertex_id' => 'id']],
            [['to_vertex_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vertex::className(), 'targetAttribute' => ['to_vertex_id' => 'id']],
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
            'distance' => 'Distance',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFromVertex()
    {
        return $this->hasOne(Vertex::className(), ['id' => 'from_vertex_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToVertex()
    {
        return $this->hasOne(Vertex::className(), ['id' => 'to_vertex_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItineraryConnections()
    {
        return $this->hasMany(ItineraryConnection::className(), ['connection_id' => 'id']);
    }
}
