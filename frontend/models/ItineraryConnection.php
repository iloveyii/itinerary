<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "itinerary_connection".
 *
 * @property integer $id
 * @property integer $itinerary_id
 * @property integer $connection_id
 * @property string $updated_at
 * @property string $created_at
 *
 * @property Connection $connection
 * @property Itinerary $itinerary
 */
class ItineraryConnection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'itinerary_connection';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['itinerary_id', 'connection_id'], 'required'],
            [['itinerary_id', 'connection_id'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['connection_id'], 'exist', 'skipOnError' => true, 'targetClass' => Connection::className(), 'targetAttribute' => ['connection_id' => 'id']],
            [['itinerary_id'], 'exist', 'skipOnError' => true, 'targetClass' => Itinerary::className(), 'targetAttribute' => ['itinerary_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'itinerary_id' => 'Itinerary ID',
            'connection_id' => 'Connection ID',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConnection()
    {
        return $this->hasOne(Connection::className(), ['id' => 'connection_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItinerary()
    {
        return $this->hasOne(Itinerary::className(), ['id' => 'itinerary_id']);
    }
}
