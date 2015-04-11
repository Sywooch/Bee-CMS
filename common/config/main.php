<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        /*
         * Подключение к базе данных
         */
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=promobv.mysql.ukraine.com.ua;dbname=promobv_bee',
            'username' => 'promobv_bee',
            'password' => '32jcmcf2',
            'charset' => 'utf8',
            'tablePrefix' => 'feq2d_'
        ],

        /*
         * Правила формирования ссылок сайта
         * Формирование ЧПУ
         */
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
        ],

        /*
         * @param enableCsrfValidation - CSRF защита от межсайтовых подделок запроса - https://ru.wikipedia.org/wiki/%D0%9C%D0%B5%D0%B6%D1%81%D0%B0%D0%B9%D1%82%D0%BE%D0%B2%D0%B0%D1%8F_%D0%BF%D0%BE%D0%B4%D0%B4%D0%B5%D0%BB%D0%BA%D0%B0_%D0%B7%D0%B0%D0%BF%D1%80%D0%BE%D1%81%D0%B0
         * @param cookieValidationKey - Секретный ключ для валидации Куки при отправке запросов
         * @param baseUrl - Удалить префикс "web/" в URL (При использовании Apache в качестве веб-сервера)
         */
        'request' => [
            'enableCsrfValidation' => true,
            'cookieValidationKey' => '8JB0z0pMnWauQAkw3bDKW9zyQtPP4FuK',
            'baseUrl' => ''
        ],

        /*
         * Настройки отправки сообщений
         * @param useFileTransport - по умолчанию отправляет емейл в виде файла,
         * который находится в /frontend/runtime/mail/
         * Для отправки почты, нужно установить значение в "FALSE"
         */
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],

        /*
         * Организация мультиязычности
         */
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'ru',
                    'basePath' => '@app/messages',
                ],
            ],
        ],

        /*
         * Настройки кеширования
         */
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        /*
         * Сквозная авторизации пользователя на всех доменах
         */
        'user' => [
            'identityClass' => 'common\modules\user\models\User', // User must implement the IdentityInterface
            'enableAutoLogin' => true,
            'identityCookie' => array('name' => '.bee-cms.local'),
        ],
        'session' => array(
//            'class' => 'yii\redis\Session', // При использоваии БД REDIS. Подробнее: http://www.yiiframework.com/doc-2.0/ext-redis-index.html
            'cookieParams' => array(
                'path' => '/',
                'domain' => '.bee-cms.local',
                'httpOnly' => true,
            ),
        ),
    ],
];
