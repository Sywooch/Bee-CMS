<?php

namespace common\libs\UrlManager;

use Yii;
use yii\web\Request;
use yii\web\UrlManager;
use yii\web\UrlRuleInterface;

/**
 * Class BeeUrlRuleHome
 * @package common\libs\UrlManager
 */
class BeeUrlRuleHome implements UrlRuleInterface
{
    /**
     * Parses the given request and returns the corresponding route and parameters.
     *
     * @param UrlManager $manager the URL manager
     * @param Request    $request the request component
     *
     * @return array|boolean the parsing result. The route and the parameters are returned as an array.
     * If false, it means this rule cannot be used to parse this path info.
     */
    public function parseRequest ($manager, $request)
    {
        echo '<pre>--- BeeUrlRuleHome ---<br>';

        $menu = Yii::$app->getSiteMenu();
        $pathInfo = $request->getPathInfo();

        if (!empty($menu->getHomeID())) {
            if ($menu->getHome()->path == $pathInfo || ($menu->getHome()->home == true && $pathInfo == '')) {

                $extAction = $menu->getHome()->query[0]; // site/index
                $url = [
                    'path' => $menu->getHome()->query['path'], // ?path=menu/submenu/page_alias
                    'id' => $menu->getHome()->query['id'], // &id=4
                ];

                echo '======================</pre>';
                return [$extAction, $url];
            }
        }

        echo '- - - - - - - - - - -</pre>';
        return FALSE;
    }

    /**
     * Creates a URL according to the given route and parameters.
     *
     * @param UrlManager $manager the URL manager
     * @param string     $route   the route. It should not have slashes at the beginning or the end.
     * @param array      $params  the parameters
     *
     * @return string|boolean the created URL, or false if this rule cannot be used for creating this URL.
     */
    public function createUrl ($manager, $route, $params)
    {
        $currentLang = Yii::$app->getSiteLangs()->getCurrent()->code;

        if (Yii::$app->getSiteMenu()->getHomeLink() == $params['path']){
            if ($currentLang === Yii::$app->getSiteLangs()->getDefault()->code) {
                return '';
            } else {
                return $currentLang;
            }
        }

        return FALSE;
    }
}