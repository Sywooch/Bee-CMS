<?php

namespace common\libs\UrlManager;

use Yii;
use yii\web\Request;
use yii\web\UrlManager;
use yii\web\UrlRuleInterface;
use common\libs\Helpers\BeeString;

/**
 * Class BeeUrlRule
 * @package common\libs\UrlManager
 */
class BeeUrlRule implements UrlRuleInterface
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
        echo '<pre>==== BeeUrlRule ===<br>';
        print_r('PathInfo = ' . $request->getPathInfo());
        echo '<br>';
        print_r('Url = ' . $request->getUrl());
        echo '<br>======================</pre>';

        $items = Yii::$app->getSiteMenu()->getMenu();

        // Parse SEF URL
        if (Yii::$app->urlManager->enablePrettyUrl == TRUE) {
            $route = $request->getPathInfo();

            /*
             *  Пошаговый парсинг меню
             *  Последне найденный записывается в переменную $found
             */
            $found = null;
            foreach ($items as $item) {
                if ($item->path && BeeString::strpos($route, $item->path) === 0) {
                    // Exact route match. We can break iteration because exact item was found.
                    if ($item->path == $route) {
                        $found = $item;
                        break;
                    }

                    // Partial route match. Item with highest level takes priority.
                    if (!$found || $found->level < $item->level) {
                        $found = $item;
                    }
                }
            }

            /*
             * Если мы нашли конечный пункт меню и его адрес полностью собпадает,
             * то формируем и возвращаем ссылку на этот пункт меню
             * иначе берем компонент в @found и продолжаем поиск уже по этому компоненту.
             */
            if (BeeString::strpos($route, $found->path) === 0) {
                $extAction = $found->query[0]; // site/index
                $url = [
                    'path' => $found->query['path'], // ?path=menu/submenu/page_alias
                    'id' => $found->query['id'], // &id=4
                ];

                return [$extAction, $url];
            } else {

                echo '<pre>';
                print_r('------------------- Еще не все распарсил -------------------');
                echo '</pre>';
            }


            //echo '<br><br><br><pre>';
            //print_r($found);
            //echo '</pre><br><br><br>';


            echo '<br><pre>Сделать парсинг для страниц, отсутствующих в меню';
            echo '<br>======================</pre>';
        } else { // Parse RAW URL
            return FALSE;
        }

        echo '<pre><<< Стандартный парсино Yii >>></pre>';
        return FALSE; //return ['site/about', []];
    }
    //public function parseRequest ($manager, $request)
    //{
    //    echo '<pre>==== BeeUrlRule ===<br>';
    //    print_r('PathInfo = ' . $request->getPathInfo());
    //    echo '<br>';
    //    print_r('Url = ' . $request->getUrl());
    //    echo '<br>======================</pre>';
    //
    //    $items = Yii::$app->getSiteMenu()->getMenu();
    //
    //    // Parse SEF URL
    //    if (Yii::$app->urlManager->enablePrettyUrl == TRUE) {
    //        $menu = [];
    //        foreach ($items as $key => $item) {
    //            $menu[$key] = [
    //                'menu_id' => $item->menu_id,
    //                'parent_id' => $item->parent_id,
    //                'level' => $item->level,
    //                'title' => $item->title,
    //                'alias' => $item->alias,
    //                'home' => $item->home,
    //                'ext_name' => $item->ext_name,
    //                'action_name' => $item->action_name,
    //                'tree' => $item->tree,
    //                'query' => $item->query,
    //            ];
    //        }
    //
    //
    //        $routeString = $request->getPathInfo();
    //        $routeArray = explode('/', $routeString);
    //        $foundItem = NULL;
    //        $menuUrl = '';
    //
    //        /*
    //         * Строим URL из существующих пунктов меню
    //         *
    //         * @return $parsUrl   часть соответствия ссылки с меню
    //         * @return $foundItem Последний найденный пункт меню,
    //         *                    содержащий информацию о модели запроса
    //         */
    //        $i = count($routeArray);
    //        $parentID = null;
    //        $isCorrectLink = false;
    //
    //        while ($i > 0) {
    //            $j = 1;
    //            foreach ($menu as $k => $item) {
    //                /*
    //                 * Бинарно-безопасное сравнение строк без учета регистра
    //                 * @link http://php.net/manual/ru/function.strcasecmp.php
    //                 */
    //                if ($compare = strcasecmp($item['alias'], $routeArray[$i - 1]) === 0) {
    //                    if ($foundItem === NULL) {
    //                        $foundItem = $item;
    //                        $parentID = $item['parent_id'];
    //                    }
    //                    $menuUrl = $menuUrl == '' ? $item['alias'] : $item['alias'] . '/' . $menuUrl;
    //                }
    //
    //                if (
    //                    ($foundItem !== NULL) &&
    //                    (
    //                        ($parentID == $item['menu_id']) ||
    //                        $compare
    //                    )
    //                ) {
    //                    if (
    //                        ($i == 1 && $item['parent_id'] == 0) ||
    //                        ($i > 1 && $item['parent_id'] != 0)
    //                    ) {
    //                        if ($compare) {
    //                            $isCorrectLink = true;
    //                            $parentID = $item['parent_id'];
    //                        } else {
    //                            $isCorrectLink = false;
    //                            return false;
    //                        }
    //                    } else {
    //                        $isCorrectLink = false;
    //                        return false;
    //                    }
    //                }
    //            }
    //            $i--;
    //        }
    //
    //        if (!$isCorrectLink) {return false;}
    //
    //        echo '<pre>';
    //        print_r('OLOLOOOOOOOOOOOOOOO<br>');
    //        print_r('isCorrectLink = ' . ($isCorrectLink == true ? 'YES' : 'NO') . '<br>');
    //        echo '</pre>';
    //
    //        /*
    //         * Бинарно-безопасное сравнение строк без учета регистра
    //         * @link http://php.net/manual/ru/function.strcasecmp.php
    //         *
    //         * Если адрес страницы полностью совпадает с составленным адресом меню
    //         * то выводим страницу меню
    //         */
    //        if (strcasecmp($routeString, $menuUrl) === 0) {
    //            return ['/' . $foundItem['ext_name'] . '/' . $foundItem['action_name'], []];
    //        }
    //
    //        echo '<br><pre>==== BeeUrlRule ===<br>';
    //        print_r('Сделать парсинг для страниц, отсутствующих в меню');
    //        echo '<br>======================</pre>';
    //
    //    } else { // Parse RAW URL
    //        return FALSE;
    //    }
    //
    //    echo '<br><pre>==== BeeUrlRule ===<br>';
    //    echo '<br>======================</pre>';
    //    return FALSE; //return ['site/about', []];
    //}

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
        $items = Yii::$app->getSiteMenu()->getMenu();
        $currentLang = Yii::$app->getSiteLangs()->getCurrent()->code;

        $extAction = preg_replace( // site/index
            '/' . $currentLang . '+(\/*)/',
            '',
            $route,
            1
        );
        $path = '?path='.$params['path']; // ?path=menu/submenu/page_alias
        $id = '&id='.$params['id']; // &id=4

        $url = $extAction.$path.$id;

        foreach ($items as $item) {
            if (strpos($item->link, $url) === 0) {
                if ($currentLang === Yii::$app->getSiteLangs()->getDefault()->code) {
                    return $item->path;
                } else {
                    return $currentLang . '/' . $item->path;
                }
            }
        }

        return FALSE; //return 'about-joomla/modules/articles-modules';
    }
}