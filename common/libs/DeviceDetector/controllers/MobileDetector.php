<?php
namespace common\libs\DeviceDetector\controllers;

use Yii;
//use yii\base\BootstrapInterface;
use common\libs\DeviceDetector\vendor\Mobile_Detect;


/**
 * Site controller
 */
class MobileDetector // implements BootstrapInterface
{
    public static function layoutTypes()
    {
        return array(
            0 => 'desktop',
            1 => 'tablet',
            2 => 'mobile'
        );
    }

    public static function getDevice () {
        $layoutTypes = self::layoutTypes();

        // Safety check.
        if(!file_exists(Yii::getAlias('@libs/DeviceDetector/vendor/Mobile_Detect.php'))){ return $layoutTypes[0]; }

        $isMobile = self::isMobile();
        $isTablet = self::isTablet();
        $session = Yii::$app->session;

        // Set the layout type.
        if (isset($_GET['layoutType']) ) {
            if ($_GET['layoutType'] == 'unset') {
                /* Очистить все стили */
                Yii::$app->session->remove('layoutType');
                $layoutType = ($isMobile ? ($isTablet ? $layoutTypes[1] : $layoutTypes[2]) : $layoutTypes[0]);
            } else {
                if (in_array($_GET['layoutType'], $layoutTypes) ) {
                    /* Загрузка стиля по GET запросу */
                    $layoutType = $_GET['layoutType'];
                } else {
                    if (!$session->has('layoutType')) {
                        /* Шаблон не существует. В сессии нет шаблона. Установка шаблона по устройству */
                        $layoutType = ($isMobile ? ($isTablet ? $layoutTypes[1] : $layoutTypes[2]) : $layoutTypes[0]);
                    } else {
                        /* Шаблон не существует. Загрузка шаблона из сессии */
                        $layoutType =  $session->get('layoutType');
                    }
                }
            }
        } else {
            if (!$session->has('layoutType')) {
                /* Установка шаблона по типу устройства */
                $layoutType = ($isMobile ? ($isTablet ? $layoutTypes[1] : $layoutTypes[2]) : $layoutTypes[0]);
            } else {
                /* Берем шаблон из сессии */
                $layoutType =  $session->get('layoutType');
            }
        }

        $session->set('layoutType', $layoutType);

        return $layoutType;
    }

    public static function isMobile()
    {
        $detect = new Mobile_Detect;
        return $detect->isMobile();
    }

    public static function getUserAgent()
    {
        $detect = new Mobile_Detect;
        return $detect->getUserAgent();
    }

    public static function getPhoneDevices()
    {
        $detect = new Mobile_Detect;
        return $detect->getPhoneDevices();
    }

    public static function getTabletDevices()
    {
        $detect = new Mobile_Detect;
        return $detect->getTabletDevices();
    }

    public static function isTablet($userAgent = null, $httpHeaders = null)
    {
        $detect = new Mobile_Detect;
        return $detect->isTablet($userAgent, $httpHeaders);
    }

    public static function is($key, $userAgent = null, $httpHeaders = null)
    {
        $detect = new Mobile_Detect;
        return $detect->is($key, $userAgent, $httpHeaders);
    }

    public static function getOperatingSystems()
    {
        $detect = new Mobile_Detect;
        return $detect->getOperatingSystems();
    }
}