<?php
/*
 * Управление шаблонами
 */
return [
    'view' => [
        'theme' => [
            'pathMap' => [
                '@administrator/views' => [
                    Yii::getAlias('@webroot/templates/base/desktop'),
                    Yii::getAlias('@webroot/templates/base/mobile')
                ],
                '@administrator/modules' => [
                    Yii::getAlias('@webroot/templates/base/desktop/modules'),
                    Yii::getAlias('@webroot/templates/base/mobile/modules')
                ],
                '@administrator/widgets' => [
                    Yii::getAlias('@webroot/templates/base/desktop/widgets'),
                    Yii::getAlias('@webroot/templates/base/mobile/widgets')
                ],
            ],
            'baseUrl' => Yii::getAlias('@webroot/templates/base/desktop'),
        ],
    ],
];