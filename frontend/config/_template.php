<?php
/*
 * Управление шаблонами
 */
return [
    'view' => [
        'theme' => [
            'pathMap' => [
                '@frontend/views' => [
                    Yii::getAlias('@webroot/templates/base/desktop'),
                    Yii::getAlias('@webroot/templates/base/tablet'),
                    Yii::getAlias('@webroot/templates/base/mobile')
                ],
                '@frontend/modules' => [
                    Yii::getAlias('@webroot/templates/base/desktop/modules'),
                    Yii::getAlias('@webroot/templates/base/tablet/modules'),
                    Yii::getAlias('@webroot/templates/base/mobile/modules')
                ],
                '@frontend/widgets' => [
                    Yii::getAlias('@webroot/templates/base/desktop/widgets'),
                    Yii::getAlias('@webroot/templates/base/tablet/widgets'),
                    Yii::getAlias('@webroot/templates/base/mobile/widgets')
                ],
            ],
            'baseUrl' => Yii::getAlias('@webroot/templates/base/desktop'),
        ],
    ],
];