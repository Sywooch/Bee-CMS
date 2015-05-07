<?php
namespace common\libs\Core\controllers;

use Yii;
use yii\i18n\PhpMessageSource;

class BeePhpMessageSource extends PhpMessageSource
{
    public function translate($category, $message, $language)
    {
            return $this->translateMessage($category, $message, $language);
    }
}