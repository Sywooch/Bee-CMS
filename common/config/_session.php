<?php
/*
 * Настройка сессий
 */
return [
//    'class' => 'yii\redis\Session', // При использоваии БД REDIS. Подробнее: http://www.yiiframework.com/doc-2.0/ext-redis-index.html
    'class' => 'yii\web\Session',
    'cookieParams' => array(
        'path' => '/',
//        'domain' => 'bee-cms.local',
//        'httpOnly' => true,
    ),
];