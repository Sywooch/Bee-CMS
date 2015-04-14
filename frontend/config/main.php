<?php
$params = array_merge(
    file_exists(__DIR__ . '/../../common/config/params.php') ? require(__DIR__ . '/../../common/config/params.php') : [],
    file_exists(__DIR__ . '/../../common/config/params-local.php') ? require(__DIR__ . '/../../common/config/params-local.php') : [],
    file_exists(__DIR__ . '/params.php') ? require(__DIR__ . '/params.php') : [],
    file_exists(__DIR__ . '/params-local.php') ? require(__DIR__ . '/params-local.php') : []
);
$components = array_merge(
    file_exists(__DIR__ . '/_template.php') ? require(__DIR__ . '/_template.php') : [],
    file_exists(__DIR__ . '/_request.php') ? require(__DIR__ . '/_request.php') : []
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'view' => $components['view'],
        'request' => $components['request'],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
];
