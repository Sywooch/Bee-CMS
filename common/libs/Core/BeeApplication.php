<?php
namespace common\libs\Core;

use Yii;
use yii\web\Application;
use common\libs\Core\Language\Language;
use common\libs\Core\Menu\Menu;

/**
 * Основное приложение BeeCMS
 * Разширяет базовый класс Yii
 */
class BeeApplication extends Application
{
    /*
     * Масив доступных языков сайта
     *
     * @var model object
     */
    public $siteLangs;

    /*
     * Масив меню текущего представления
     * frontend, administrator, developer
     *
     * @var model object
     */
    public $siteMenu;


    public function __construct ($config = []) {
        parent::__construct($config);

        if (empty($this->siteLangs)) {
            $this->siteLangs = new Language();
        }

        if (empty($this->siteMenu)) {
            $this->siteMenu = new Menu();
        }
    }

    /**
     * @var BeeApplication $setSiteLangs
     * @return array Устанавливает доступные языковые версии сайта
     */
    public function setSiteLangs($lang)
    {
        $this->siteLangs = $lang;
    }

    /**
     * Доступные языковые версии сайта
     * @var BeeApplication $getSiteLangs
     * @return array
     */
    public function getSiteLangs()
    {
        return $this->siteLangs;
    }

    /**
     * @return array Устанавливает меню
     */
    public function setSiteMenu($menu)
    {
        $this->siteMenu = $menu;
    }

    /**
     * Возвращает обьект меню текущего приложения
     * @var BeeApplication $getSiteMenu
     * @return array Меню сайта текущего приложения
     */
    public function getSiteMenu()
    {
        return $this->siteMenu;
    }

    /*
     * Функция проверки класса на существование
     * Проверка осуществляется по следующему пути:
     * app\components\__controller__\controllers\__controller__Controller
     *
     * @return boolean
     */
    public function isControllerExist ($controller) {
        return class_exists(Yii::$app->id.'\components\\'.$controller.'\controllers\\'.ucfirst($controller).'Controller');
    }
}
