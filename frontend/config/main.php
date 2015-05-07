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
    'id' => 'frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\components\site\controllers',
    'components' => [
        'view' => $components['view'],
        'request' => $components['request'],
        'urlManager' => [
            'rules' => [
//                '/'                             => 'site/index',
//                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],

        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'common\libs\Core\controllers\BeePhpMessageSource',
    //            'sourceLanguage' => 'en-US', // исходный язык
    //            'language' => 'ru-RU', // язык перевода
                    'basePath' => __DIR__.'/../../frontend/language',
                    'on missingTranslation' => ['common\libs\Core\Language\TranslationEventHandler', 'handleMissingTranslation'],
                ],
            ],
        ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
//            'keyPrefix' => 'myapp_',
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
    ],
    'params' => $params,
];
