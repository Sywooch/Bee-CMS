<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use frontend\widgets\BeeNav;
use frontend\templates\base\desktop\assets\AppAsset;
use frontend\widgets\Alert;
use frontend\widgets\Language\LanguageSwitcher;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin(
        [
            'brandLabel' => 'My Company',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]
    );
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index', 'viev' => 'Some_Tmpl', 'id' => '5554', '#' => 'QWERTY'], 'options' => ['menu_type' => 'top_menu']],
        ['label' => 'About', 'url' => ['/site/about'], 'options' => ['menu_type' => 'top_menu']],
        ['label' => 'AboutID', 'url' => ['/site/about', 'id' => '324243234'], 'options' => ['menu_type' => 'top_menu']],
        ['label' => 'Contact', 'url' => ['/site/contact'], 'options' => ['menu_type' => 'top_menu']],
        [
            'label' => 'Styles', 'url' => ['/site/contact'], 'options' => ['menu_type' => 'top_menu'],
            'items' => [
                '<li class="dropdown-header">Set your style</li>',
                '<li class="divider"></li>',
                ['label' => 'desktop', 'url' => '?layoutType=desktop', 'options' => ['menu_type' => 'top_menu']],
                ['label' => 'tablet', 'url' => '?layoutType=tablet', 'options' => ['menu_type' => 'top_menu']],
                ['label' => 'mobile', 'url' => '?layoutType=mobile', 'options' => ['menu_type' => 'top_menu']],
                ['label' => 'По умолчанию', 'url' => '?layoutType=unset', 'options' => ['menu_type' => 'top_menu']],
            ],
        ],

    ];
    //echo '<br><br><br><pre>';
    //print_r($menuItems);
    //echo '</pre>';
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup'], 'options' => ['menu_type' => 'top_menu']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login'], 'options' => ['menu_type' => 'top_menu']];
    } else {
        $menuItems[] = [
            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post'],
            'options' => ['menu_type' => 'top_menu']
        ];
    }
    $menuItems[] = Html::beginTag('div', ['class' => 'right']) . LanguageSwitcher::widget() . Html::endTag('div');

    echo BeeNav::widget(
        [
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]
    );
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget(
            ['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]
        ) ?>

        <?php
        $menuItems = [
            [
                'label' => 'Home',
                'url' => ['/site/index', 'viev' => 'Some_Tmpl', 'id' => '5554', '#' => 'QWERTY'],
                'options' => ['menu_type' => 'top_menu']
            ],
            ['label' => 'About', 'url' => ['/site/about'], 'options' => ['menu_type' => 'top_menu']]
        ];
        $modelMenu = Yii::$app->getSiteMenu();
        $items = $modelMenu->getMenuItems('mainmenu');
        foreach ($items as $item) {
            $menuItems[] = [
                'menu_id' => $item['menu_id'],
                'parent_id' => $item['parent_id'],
                'label' => $item['label'],
                'url' => $item['url'],
                'options' => $item['options'],
                'items' => $item['items'],
            ];
        }

        NavBar::begin(['options' => [],]);
        echo Nav::widget(
            [
                'options' => ['class' => 'navbar-nav'],
                'items' => $menuItems,
                'activateParents' => true
            ]
        );
        NavBar::end();
        ?>

        <?php echo \Yii::t('site', 'TEST_FOR_SOME') ?>
        <br>
        <?= 'MSystem language: ' . Yii::$app->sourceLanguage ?><br>
        <?= 'My current language: ' . Yii::$app->language ?>
        <br>
        <?= Html::a('Ebglish', ['site/index', 'lang' => 'en', 'id' => 'dsfsdf']); ?><br>
        <?= Html::a('Русский', ['site/index', 'lang' => 'ru']); ?><br>
        <?= Html::a('Українська', ['site/index', 'lang' => 'ua']); ?><br>


        <?= Alert::widget() ?>
        <h2>\BASE\desktop</h2>
        <img src="/frontend/templates/base/desktop/images/logo_laserjet.png">
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
