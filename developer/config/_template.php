<?php
/*
 * Управление шаблонами
 */
return [
    'view' => [
        'theme' => [
            'pathMap' => [
                '@developer/views' => [
                    Yii::getAlias('@developer/templates/base/desktop'),
                    Yii::getAlias('@developer/templates/base/tablet'),
                    Yii::getAlias('@developer/templates/base/mobile')
                ],
                '@developer/modules' => [
                    Yii::getAlias('@developer/templates/base/desktop/modules'),
                    Yii::getAlias('@developer/templates/base/tablet/modules'),
                    Yii::getAlias('@developer/templates/base/mobile/modules')
                ],
                '@developer/widgets' => [
                    Yii::getAlias('@developer/templates/base/desktop/widgets'),
                    Yii::getAlias('@developer/templates/base/tablet/widgets'),
                    Yii::getAlias('@developer/templates/base/mobile/widgets')
                ],
            ],
            'baseUrl' => Yii::getAlias('@developer/templates/base/desktop'),
        ],
    ],
];