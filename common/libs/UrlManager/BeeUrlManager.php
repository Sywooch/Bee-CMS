<?php
namespace common\libs\UrlManager;

use Yii;
use yii\web\UrlManager;
use yii\helpers\ArrayHelper;

class BeeUrlManager extends UrlManager
{
    /**
     * @var bool Whether to display the source app language in the URL
     */
    public $displaySourceLanguage = false;

    /**
     * @var string Parameter used to set the language
     */
    public $languageParam = 'lang';


    /**
     * //return parent::parseRequest($request);
     *
     * Parses the URL and sets the language accordingly
     *
     * @param \yii\web\Request $request
     *
     * @return array|bool
     */
    public function parseRequest ($request)
    {
        echo '<br><br><br><pre style="text-align: center; font-weight: bold; font-size: large;">===^ BeeUrlManager ^===</pre>';

        //return parent::parseRequest($request);

        // From Yii
        if ($this->enablePrettyUrl) {
            $pathInfo = $request->getPathInfo();

            /* @var $rule UrlRule */
            foreach ($this->rules as $rule) {
                if (($result = $rule->parseRequest($this, $request)) !== FALSE) {
                    return $result;
                }
            }

            if ($this->enableStrictParsing) {
                return FALSE;
            }

            Yii::trace('No matching URL rules. Using default URL parsing logic.', __METHOD__);

            $suffix = (string)$this->suffix;
            if ($suffix !== '' && $pathInfo !== '') {
                $n = strlen($this->suffix);
                if (substr_compare($pathInfo, $this->suffix, -$n, $n) === 0) {
                    $pathInfo = substr($pathInfo, 0, -$n);
                    if ($pathInfo === '') {
                        // suffix alone is not allowed
                        return FALSE;
                    }
                } else {
                    // suffix doesn't match
                    return FALSE;
                }
            }

            return [$pathInfo, []];
        } else {
            Yii::trace('Pretty URL not enabled. Using default URL parsing logic.', __METHOD__);
            $route = $request->getQueryParam($this->routeParam, '');
            if (is_array($route)) {
                $route = '';
            }

            return [(string) $route, []];
        }

        // Парсинг УРЛ
        //if ($this->enablePrettyUrl) {
        //    $pathInfo = $request->getPathInfo();
        //    $language = explode('/', $pathInfo)[0];
        //    //$locale = ArrayHelper::getValue(self::$allLanguages->getLanguagesStructure()->aliases, $language, $language);
        //
        //    if (in_array($request, self::$allLanguages->getLanguagesStructure()->aliases)) {
        //        $request->setPathInfo(substr_replace($pathInfo, '', 0, (strlen($language) + 1)));
        //    }
        //
        //    //return [$pathInfo, []];
        //} else {
        //    $params = $request->getQueryParams();
        //    $route = isset($params[$this->routeParam]) ? $params[$this->routeParam] : '';
        //    if (is_array($route)) {
        //        $route = '';
        //    }
        //    $language = explode('/', $route)[0];
        //    //$locale = ArrayHelper::getValue(self::$allLanguages->getLanguagesStructure()->aliases, $language, $language);
        //
        //    if (in_array($language, self::$allLanguages->getLanguagesStructure()->languages)) {
        //        $route = substr_replace($route, '', 0, (strlen($language) + 1));
        //        $params[$this->routeParam] = $route;
        //        $request->setQueryParams($params);
        //    }
        //    //return [(string) $route, []];
        //}
    }

    /**
     * // generates: /index.php?r=site/index&param1=value1&param2=value2
     * ['site/index', 'param1' => 'value1', 'param2' => 'value2']
     *
     * Adds language functionality to URL creation
     *
     * @param array|string $params
     *
     * @return string
     */
    public function createUrl ($params)
    {
        if (array_key_exists($this->languageParam, $params)) {
            $lang = $params[$this->languageParam];

            if ((($lang !== Yii::$app->sourceLanguage && ArrayHelper::getValue(
                            Yii::$app->getSiteLangs()->getLanguages()->code,
                            $lang
                        ) !== Yii::$app->sourceLanguage) || $this->displaySourceLanguage) && !empty($lang)
            ) {
                // Не добавлять алиас к главной странице
                if (Yii::$app->getSiteMenu()->getHomeLink() == $params[0]) {
                    $params[0] = $lang;
                } else {
                    $params[0] = $lang . '/' . ltrim($params[0], '/');
                }
            }
            unset($params[$this->languageParam]);
        } else {
            if (Yii::$app->language !== Yii::$app->sourceLanguage || $this->displaySourceLanguage) {
                // Не добавлять алиас к главной странице
                if (Yii::$app->getSiteMenu()->getHomeLink() == $params[0]) {
                    $params[0] = Yii::$app->getSiteLangs()->getCurrent()->code;
                } else {
                    $params[0] = Yii::$app->getSiteLangs()->getCurrent()->code . '/' . ltrim($params[0], '/');
                }
            }
        }

        //return parent::createUrl($params);
        // From Yii
        $params = (array) $params;
        $anchor = isset($params['#']) ? '#' . $params['#'] : '';
        unset($params['#'], $params[$this->routeParam]);

        $route = trim($params[0], '/');
        unset($params[0]);

        $baseUrl = $this->showScriptName && !$this->enablePrettyUrl ? $this->getScriptUrl() : $this->getBaseUrl();

        if ($this->enablePrettyUrl) {
            /* @var $rule UrlRule */
            foreach ($this->rules as $rule) {
                if (($url = $rule->createUrl($this, $route, $params)) !== false) {
                    $url = str_replace('%2F', '/', $url);
                    if (strpos($url, '://') !== false) {
                        if ($baseUrl !== '' && ($pos = strpos($url, '/', 8)) !== false) {
                            return substr($url, 0, $pos) . $baseUrl . substr($url, $pos);
                        } else {
                            return $url . $baseUrl . $anchor;
                        }
                    } else {
                        return "$baseUrl/{$url}{$anchor}";
                    }
                }
            }

            if ($this->suffix !== null) {
                $route .= $this->suffix;
            }
            if (!empty($params) && ($query = http_build_query($params)) !== '') {
                $route .= '?' . $query;
            }

            return "$baseUrl/{$route}{$anchor}";
        } else {
            $url = "$baseUrl?{$this->routeParam}=" . urlencode($route);
            $url = str_replace('%2F', '/', $url);
            if (!empty($params) && ($query = http_build_query($params)) !== '') {
                $url .= '&' . $query;
            }

            return $url . $anchor;
        }
    }
}