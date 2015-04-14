<?php
/*
 * Подключение к базе данных
 */
return [
    'db' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=promobv.mysql.ukraine.com.ua;dbname=promobv_bee',
        'username' => 'promobv_bee',
        'password' => '32jcmcf2',
        'charset' => 'utf8',
        'tablePrefix' => 'feq2d_'
    ],
];