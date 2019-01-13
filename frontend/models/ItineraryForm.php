<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ItineraryForm extends Model
{
    public $from;
    public $to;
    public $date;

    public $username;
    public $password;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from', 'to', 'date', 'username', 'password'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'from' => 'From City',
            'to' => 'To City',
            'date' => 'Departure Date',
        ];
    }
}
