<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "vertex".
 *
 * @property integer $id
 * @property string $iata
 * @property string $name
 * @property string $updated_at
 * @property string $created_at
 *
 * @property Connection[] $connections
 * @property Connection[] $connections0
 */
class Vertex extends \yii\db\ActiveRecord
{
    public $status;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vertex';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iata'], 'required'],
            [['updated_at', 'created_at'], 'safe'],
            [['iata'], 'string', 'max' => 4],
            [['name'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'iata' => 'Iata',
            'name' => 'Name',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConnections()
    {
        return $this->hasMany(Connection::className(), ['from_vertex_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConnections0()
    {
        return $this->hasMany(Connection::className(), ['to_vertex_id' => 'id']);
    }

    public static function listVertex()
    {
        return ArrayHelper::map(Vertex::find()->select(['id', 'name'])->all(), 'id', 'name');
    }
}
