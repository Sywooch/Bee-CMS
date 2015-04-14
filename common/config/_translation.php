<?php
/*
 * Организация мультиязычности
 */
return [
    'i18n' => [
        'translations' => [
            '*' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'ru',
                'basePath' => '@app/messages',
            ],
        ],
    ],
];