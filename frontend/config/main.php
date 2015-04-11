<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'language' => 'ru-RU',
    'sourceLanguage' => 'en-US',
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'urlManager' => [
            'rules' => [
                '/'                                        => 'site/index',
                '/<controller:\w+>'                        => '<controller>/index',
                '/<controller:\w+>/<action:\w+>/<id:\d+>'  => '<controller>/<action>',
                '/<controller:\w+>/<action:\w+>'           => '<controller>/<action>',
            ]
        ],
//        'view' => [
//            'theme' => [
//                'pathMap' => [
//                    '@app/views' => '@app/templates/base',
//                ],
//                'baseUrl' => '@app/templates/base',
//            ],
//        ],

//        'view'         => [
//            'defaultExtension' => 'twig',
//            'theme'            => [
//                'basePath' => '@app/themes/default',
//                'baseUrl'  => '@web/themes/default'
//            ],
//            'renderers'        => [
//                'twig' => [
//                    'class'      => '\yii\twig\ViewRenderer',
//                    'cachePath'  => '@runtime/twig/cache',
//                    'globals'    => [
//                        'html' => '\yii\helpers\Html'
//                    ],
//                    'filters'    => [
//                        'dump'       => '\yii\helpers\BaseVarDumper::dump'
//                    ],
//                    'namespaces' => [
//                        '@app/themes/default/views/layouts' => 'layouts',
//                        '@app/views/layouts'                => 'layouts',
//                        '@app/themes/default/views'         => '__main__',
//                        '@app/views'                        => '__main__'
//                    ]
//                ]
//            ]
//        ],

        'user' => [
            'identityClass' => 'common\modules\user\models\User',
            'enableAutoLogin' => true,
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
    ],
    'params' => $params,
];
