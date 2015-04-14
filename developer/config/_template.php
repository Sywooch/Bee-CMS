<?php
/*
 * Управление шаблонами
 */
return [
    'view' => [
        'theme' => [
            'pathMap' => [
                '@developer/views' => [
                    Yii::getAlias('@webroot/templates/base/desktop'),
                    Yii::getAlias('@webroot/templates/base/mobile')
                ],
                '@developer/modules' => [
                    Yii::getAlias('@webroot/templates/base/desktop/modules'),
                    Yii::getAlias('@webroot/templates/base/mobile/modules')
                ],
                '@developer/widgets' => [
                    Yii::getAlias('@webroot/templates/base/desktop/widgets'),
                    Yii::getAlias('@webroot/templates/base/mobile/widgets')
                ],
            ],
            'baseUrl' => Yii::getAlias('@webroot/templates/base/desktop'),
        ],
    ],
];