<?php
namespace common\controllers;

use Yii;
use yii\base\BootstrapInterface;
use \common\controllers\Mobile_Detect;


/**
 * Site controller
 */
class TemplateUiController // implements BootstrapInterface
{
    public function layoutTypes()
    {
        return array(
            0 => 'desktop',
            1 => 'mobile',
            2 => 'tablet'
        );
    }

    public function getDevice () {
        // Safety check.
        $layoutTypes = TemplateUiController::layoutTypes();
        if(!file_exists(__DIR__.'/Mobile_Detect.php')){ return $layoutTypes[0]; }
        $detect = new Mobile_Detect;
        $isMobile = $detect->isMobile();
        $isTablet = $detect->isTablet();

        // Set the layout type.
        if ( isset($_GET['layoutType']) ) {
            $layoutType = $_GET['layoutType'];
        } else {
            if (empty($_SESSION['layoutType'])) {
                $layoutType = ($isMobile ? ($isTablet ? $layoutTypes[2] : $layoutTypes[1]) : $layoutTypes[0]);
            } else {
                $layoutType =  $_SESSION['layoutType'];
            }
        }

        // Fallback. If everything fails choose classic layout.
        if ( !in_array($layoutType, $layoutTypes) ) { $layoutType = $layoutTypes[0]; }

        // Store the layout type for future use.
        $_SESSION['layoutType'] = $layoutType;
        return $layoutType;
    }
}