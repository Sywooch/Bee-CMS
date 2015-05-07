<?php
$db = file_exists(__DIR__ . '/_db.php') ? require(__DIR__ . '/_db.php') : [];
$url = file_exists(__DIR__ . '/_url.php') ? require(__DIR__ . '/_url.php') : [];
$user = file_exists(__DIR__ . '/_user.php') ? require(__DIR__ . '/_user.php') : [];
$mailer = file_exists(__DIR__ . '/_mail.php') ? require(__DIR__ . '/_mailer.php') : [];
$request = file_exists(__DIR__ . '/_request.php') ? require(__DIR__ . '/_request.php') : [];
$session = file_exists(__DIR__ . '/_session.php') ? require(__DIR__ . '/_session.php') : [];
$translation = file_exists(__DIR__ . '/_translation.php') ? require(__DIR__ . '/_translation.php') : [];

$config = [
    'id' => 'app-common',
    'name' => 'BeeCMS',
    'version' => '1.0',
    'charset' => 'utf-8',
    'sourceLanguage' => 'ru-RU', // основной язык системы
    'language' => 'ru-RU', // язык перевода
    'timeZone' => 'Europe/Moscow',
    'layout' => 'index',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => $db,
        'urlManager' => $url,
        'user' => $user,
        'mailer' => $mailer,
        'request' => $request,
        'session' => $session,
        'i18n' => $translation,

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

