<?php
namespace developer\templates\base\mobile\assets;

use yii\web\AssetBundle;

/**
 * Class AppAsset
 * Ассеты темы
 * @package app\themes\demo\assets
 * @author Churkin Anton <webadmin87@gmail.com>
 */
class AppAsset extends AssetBundle
{
    public $basePath = '/developer/templates/base/mobile';
    public $baseUrl = '/developer/templates/base/mobile';
    public $css = [
        'css/styles.css'
    ];
    public $js = [];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
