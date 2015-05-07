<?php
namespace common\libs\Core\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class CoreController extends Controller
{
    public static function getComponentViewPath($controllerPath) {
        return $controllerPath.'/../views';
    }
}