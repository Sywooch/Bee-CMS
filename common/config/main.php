<?php
$params = yii\helpers\ArrayHelper::merge(
    file_exists(__DIR__ . '/_db.php') ? require(__DIR__ . '/_db.php') : [],
    file_exists(__DIR__ . '/_url.php') ? require(__DIR__ . '/_url.php') : [],
    file_exists(__DIR__ . '/_user.php') ? require(__DIR__ . '/_user.php') : [],
    file_exists(__DIR__ . '/_mail.php') ? require(__DIR__ . '/_mail.php') : [],
    file_exists(__DIR__ . '/_request.php') ? require(__DIR__ . '/_request.php') : [],
    file_exists(__DIR__ . '/_session.php') ? require(__DIR__ . '/_session.php') : [],
    file_exists(__DIR__ . '/_translation.php') ? require(__DIR__ . '/_translation.php') : []
);

$config = [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => isset($params['db']) ? $params['db'] : [],
        'urlManager' => isset($params['urlManager']) ? $params['urlManager'] : [],
        'user' => isset($params['user']) ? $params['user'] : [],
        'mailer' => isset($params['mailer']) ? $params['mailer'] : [],
        'request' => isset($params['request']) ? $params['request'] : [],
        'session' => isset($params['session']) ? $params['session'] : [],
        'i18n' => isset($params['i18n']) ? $params['i18n'] : [],

        'cache' => [
            'class' => 'yii\caching\FileCache',
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
];

if (YII_ENV_DEV || YII_ENV_TEST) { //!YII_ENV_TEST
    return yii\helpers\ArrayHelper::merge(
        $config,
        file_exists(__DIR__ . '/_environment.php') ? require(__DIR__ . '/_environment.php') : []
    );
} else {
    return $config;
}

