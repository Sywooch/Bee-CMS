<?php
namespace developer\templates\base\desktop\assets;

use yii\web\AssetBundle;

/**
 * Class AppAsset
 * Ассеты темы
 * @package app\themes\demo\assets
 * @author Churkin Anton <webadmin87@gmail.com>
 */
class AppAsset extends AssetBundle
{
    public $basePath = '/developer/templates/base/desktop';
    public $baseUrl = '/developer/templates/base/desktop';
    public $css = [
        'css/styles.css'
    ];
    public $js = [];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
