<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ticket".
 *
 * @property integer $id
 * @property integer $itinerary_id
 * @property integer $price
 * @property integer $quantity
 * @property string $updated_at
 * @property string $created_at
 */
class Ticket extends \yii\db\ActiveRecord
{
    public $itName;
    public $status;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['itinerary_id', 'price', 'quantity'], 'required'],
            [['itinerary_id', 'price', 'quantity'], 'integer'],
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
            'itinerary_id' => 'Itinerary ID',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    public function getItinerary()
    {
        return $this->hasOne(Itinerary::className(), 'id', 'itinerary_id');
    }

    public function getItName()
    {
        return Itinerary::getItname($this->itinerary_id);
    }


}
