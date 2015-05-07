<?php

namespace frontend\widgets\Language;

use Yii;
use yii\base\Widget;
use yii\bootstrap\ButtonDropdown;

class LanguageSwitcher extends Widget
{
    public $allLanguages;
    public $currentLang;

    public function init ()
    {
        $this->allLanguages = Yii::$app->getSiteLangs()->getLanguages();
        $this->currentLang = Yii::$app->getSiteLangs()->getCurrent();

        parent::init();
    }

    public function run ()
    {
        $items = [];
        $currentUrl = preg_replace(
            '/' . $this->currentLang->code . '+(\/*)/',
            '',
            Yii::$app->getRequest()->getUrl(),
            1
        );
        foreach ($this->allLanguages->code as $key => $language) {
            $temp = [];

            /* Добавление языковой приставки только к второстепенным языкам */
            if (($language !== Yii::$app->sourceLanguage) || Yii::$app->getUrlManager()->displaySourceLanguage
            ) {
                $url = '/' . $key . $currentUrl;
            } else {
                $url = $currentUrl;
            }

            if (Yii::$app->language !== $language) {
                $temp['label'] = $this->allLanguages->title[$key];
                $temp['url'] = $url;
                array_push($items, $temp);
                //$item = ['label' => $language['name'], 'url' => $url];
            }
        }

        echo ButtonDropdown::widget(
            [
                'label' => $this->currentLang->title,
                'dropdown' => [
                    'items' => $items,
                ],
            ]
        );
    }

}