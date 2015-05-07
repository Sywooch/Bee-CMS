<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\widgets;

use Yii;
use yii\bootstrap\Nav;

/**
 * Nav renders a nav HTML component.
 *
 * For example:
 *
 * ```php
 * echo Nav::widget([
 *     'items' => [
 *         [
 *             'label' => 'Home',
 *             'url' => ['site/index'],
 *             'linkOptions' => [...],
 *         ],
 *         [
 *             'label' => 'Dropdown',
 *             'items' => [
 *                  ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
 *                  '<li class="divider"></li>',
 *                  '<li class="dropdown-header">Dropdown Header</li>',
 *                  ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
 *             ],
 *         ],
 *     ],
 *     'options' => ['class' =>'nav-pills'], // set this to nav-tab to get tab-styled navigation
 * ]);
 * ```
 *
 * Note: Multilevel dropdowns beyond Level 1 are not supported in Bootstrap 3.
 *
 * @see http://getbootstrap.com/components/#dropdowns
 * @see http://getbootstrap.com/components/#nav
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @since 2.0
 */
class BeeNav extends Nav
{
    /**
     * Checks whether a menu item is active.
     * This is done by checking if [[route]] and [[params]] match that specified in the `url` option of the menu item.
     * When the `url` option of a menu item is specified in terms of an array, its first element is treated
     * as the route for the item and the rest of the elements are the associated parameters.
     * Only when its route and parameters match [[route]] and [[params]], respectively, will a menu item
     * be considered active.
     * @param array $item the menu item to be checked
     * @return boolean whether the menu item is active
     */
    protected function isItemActive($item)
    {
        if (isset($item['options']['menu_type'])) {
            if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
                $route = ltrim($item['url'][0], '/');

                if ($route === Yii::$app->request->getPathInfo()) {
                    if ($route !== '/' && Yii::$app->controller) {
                        $route = ltrim(Yii::$app->controller->module->getUniqueId() . '/' . $route, '/');
                    }
                    if ($route !== $this->route) {
                        return TRUE;
                    }
                    unset($item['url']['#']);
                    if (count($item['url']) > 1) {
                        foreach (array_splice($item['url'], 1) as $name => $value) {
                            if ($value !== NULL && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
                                return FALSE;
                            }
                        }
                    }

                    return TRUE;
                } else {
                    if (isset($item['options']['home']) && $item['options']['home'] == 1 && Yii::$app->request->getPathInfo(
                        ) === ''
                    ) {
                        return TRUE;
                    }

                    if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
                        $route = $item['url'][0];
                        if ($route[0] !== '/' && Yii::$app->controller) {
                            $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
                        }
                        if (ltrim($route, '/') !== $this->route) {
                            return FALSE;
                        }
                        unset($item['url']['#']);
                        if (count($item['url']) > 1) {
                            foreach (array_splice($item['url'], 1) as $name => $value) {
                                if ($value !== NULL && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
                                    return FALSE;
                                }
                            }
                        }

                        return TRUE;
                    }

                    return FALSE;
                }
            }
        }
        return false;
    }
}
