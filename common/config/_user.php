<?php
/*
 * Сквозная авторизации пользователя на всех доменах
 */
return [
    'identityClass' => 'common\models\User', // User must implement the IdentityInterface
    'enableAutoLogin' => false,
    'identityCookie' => array('name' => '.bee-cms.local'),
];