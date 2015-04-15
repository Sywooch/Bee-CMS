<?php
namespace common\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class CoreController extends Controller
{
    function getComponentViewPath($controllerPath) {
        return $controllerPath.'/../views';
    }
}