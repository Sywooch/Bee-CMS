<?php
/*
 * Правила формирования ссылок сайта
 * Формирование ЧПУ
 */
return [
    'class' => 'common\libs\UrlManager\BeeUrlManager',
    'displaySourceLanguage' => false, // True - показывать языковую версию сайта постоянно,
                                      // False - показывать при выборе только дополнительных языков.
                                      // При этом основной язык будет открыватся как корень сайта
    'languageParam' => 'lang', // Префикс в URL для установки языка
    'enablePrettyUrl' => true, // ЧПУ
    'showScriptName' => false, // Вывод ссылок без index.php
    'enableStrictParsing' => true, // убираем дубли ссылок
    //'suffix' => '.html',
    'rules' => [
        [   // Правило для Главной страницы
            'class' => 'common\libs\UrlManager\BeeUrlRuleHome',
        ],
        [   // Правило для страниц с alias
            'class' => 'common\libs\UrlManager\BeeUrlRule',
        ],
        //[   // Правило для Controller/Action/ID без использования alias
        //    'pattern' => '<controller:\w+>/<action:\w+>/<id:\w+>',
        //    'route' => '<controller>/<action>',
        //],
        [   // Правило для Controller/Action без использования alias
            'pattern' => '<controller:\w+>/<action:\w+>',
            'route' => '<controller>/<action>',
        ],
    ],
];