<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Exception;

class Client
{
    private $instance;

    public function __construct()
    {
        $params = array(
            'location'=>'http://hw2.loc/withWsdl/server/webservice.php',
            'uri'=>'urn://hw2.loc/withWsdl/server/webservice.php',
            'trace'=>1
        );

        if( ! extension_loaded('soap') || ! class_exists("SOAPClient")) {
            die('Soap extension not installed.');
        }

        $this->instance = new \SoapClient(null, $params);
        // $this->addAuthentication('alex', 'bbb');

    }

    public function addAuthentication($userName, $password)
    {
        // Set Soap Header
        $auth_params = new \stdClass();
        $auth_params->username = $userName;
        $auth_params->password = $password;
        $header_params = new \SoapVar($auth_params, SOAP_ENC_OBJECT);
        // the 'auth' namespace has no effect in the soap envelope .. bug
        $header = new \SoapHeader('auth', 'authenticate', $header_params, false);
        $this->instance->__setSoapHeaders($header);
    }

    /**
     * Task 1
     * @return mixed
     */
    public function getLastResponse()
    {
        // $this->instance->authenticate($customer_array['username'], $customer_array['password']);
        return $this->instance->__getLastResponse() ;
    }

    /**
     * Task 2
     * @param $itinerary_array
     * @return mixed
     */
    public function findItinerary($itinerary_array)
    {
        try {
            return $this->instance->findItinerary($itinerary_array);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Task 3
     * @param $itinerary_array
     * @return mixed
     */
    public function findAvailabilityAndPrice($itinerary_array)
    {
        return $this->instance->findAvailabilityAndPrice($itinerary_array);
    }


}


    // Run tcp flow to  see traffic
    // sudo tcpflow -p -c port 80 -i lo