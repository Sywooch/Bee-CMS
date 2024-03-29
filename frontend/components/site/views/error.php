<?php

use Yii;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>
    <br>
    <?= 'MSystem language: ' . Yii::$app->sourceLanguage ?><br>
    <?= 'My current language: ' . Yii::$app->language ?>
    <br>
    <?=  Html::a('Ebglish', ['site/index', 'lang'=>'en', 'id'=>'dsfsdf']); ?><br>
    <?=  Html::a('Русский', ['site/index', 'lang'=>'ru']); ?><br>
    <?=  Html::a('Українська', ['site/index', 'lang'=>'ua']); ?><br>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>
