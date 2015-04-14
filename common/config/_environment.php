<?php
/*
 * Настройка окружния
 * Дебагер и генератор кода
 */
return [
    'modules' => array(
        'debug' => 'yii\debug\Module',
        'gii' => 'yii\gii\Module',
    ),
    'bootstrap' => array(
        'debug',
        'gii'
    ),
];