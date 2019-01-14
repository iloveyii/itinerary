<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'vertex/index',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'GET /api/vertex' => 'vertex/apiindex',
                'GET /api/vertex/<id:\d+>' => 'vertex/apiview',
                'POST /api/vertex' => 'vertex/apicreate',
                'PUT /api/vertex/<id:\d+>' => 'vertex/apiupdate',
                'DELETE /api/vertex/<id:\d+>' => 'vertex/apidelete',

                'GET /api/ticket' => 'ticket/apiindex',
                'GET /api/ticket/<id:\d+>' => 'ticket/apiview',
                'POST /api/ticket' => 'ticket/apicreate',
                'PUT /api/ticket/<id:\d+>' => 'ticket/apiupdate',
                'DELETE /api/ticket/<id:\d+>' => 'ticket/apidelete',

                'GET /api/connection' => 'connection/apiindex',
                'GET /api/connection/<id:\d+>' => 'connection/apiview',
                'POST /api/connection/create' => 'connection/apiCreate',
                'PUT /api/connection/update/<id:\d+>' => 'connection/apiUpdate',
                'DELETE /api/connection/delete/<id:\d+>' => 'connection/api/Delete',

                'GET /api/itinerary' => 'itinerary/apiindex',
                'GET /api/itinerary/<id:\d+>' => 'itinerary/apiview',
                'POST /api/itinerary/create' => 'itinerary/apiCreate',
                'PUT /api/itinerary/update/<id:\d+>' => 'itinerary/apiUpdate',
                'DELETE /api/itinerary/delete/<id:\d+>' => 'itinerary/api/Delete',

                '<controller:(vertex|ticket|itinerary|connection)>/<id:\d+>/<action:(update|delete)>' => '<controller>/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
            ],
        ],
    ],
    'params' => $params,
];
