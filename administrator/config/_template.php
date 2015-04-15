<?php
/*
 * Управление шаблонами
 */
return [
    'view' => [
        'theme' => [
            'pathMap' => [
                '@administrator/views' => [
                    Yii::getAlias('@administrator/templates/base/desktop'),
                    Yii::getAlias('@administrator/templates/base/tablet'),
                    Yii::getAlias('@administrator/templates/base/mobile')
                ],
                '@administrator/modules' => [
                    Yii::getAlias('@administrator/templates/base/desktop/modules'),
                    Yii::getAlias('@administrator/templates/base/tablet/modules'),
                    Yii::getAlias('@administrator/templates/base/mobile/modules')
                ],
                '@administrator/widgets' => [
                    Yii::getAlias('@administrator/templates/base/desktop/widgets'),
                    Yii::getAlias('@administrator/templates/base/tablet/widgets'),
                    Yii::getAlias('@administrator/templates/base/mobile/widgets')
                ],
            ],
            'baseUrl' => Yii::getAlias('@administrator/templates/base/desktop'),
        ],
    ],
];