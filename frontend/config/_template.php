<?php
/*
 * Управление шаблонами
 */
return [
    'view' => [
        'theme' => [
            'pathMap' => [
                '@frontend/views' => [
                    Yii::getAlias('@frontend/templates/base/desktop'),
                    Yii::getAlias('@frontend/templates/base/tablet'),
                    Yii::getAlias('@frontend/templates/base/mobile')
                ],
                '@frontend/modules' => [
                    Yii::getAlias('@frontend/templates/base/desktop/modules'),
                    Yii::getAlias('@frontend/templates/base/tablet/modules'),
                    Yii::getAlias('@frontend/templates/base/mobile/modules')
                ],
                '@frontend/widgets' => [
                    Yii::getAlias('@frontend/templates/base/desktop/widgets'),
                    Yii::getAlias('@frontend/templates/base/mobile/widgets'),
                    Yii::getAlias('@frontend/templates/base/mobile/widgets')
                ],
            ],
            'baseUrl' => Yii::getAlias('@frontend/templates/base/desktop'),
        ],
    ],
];