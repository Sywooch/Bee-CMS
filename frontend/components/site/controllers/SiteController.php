<?php
namespace frontend\components\site\controllers;

use Yii;
use yii\base\ViewContextInterface;
use common\models\LoginForm;
use frontend\components\site\models\PasswordResetRequestForm;
use frontend\components\site\models\ResetPasswordForm;
use frontend\components\site\models\SignupForm;
use frontend\components\site\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use \common\libs\DeviceDetector\controllers\MobileDetector;

/**
 * Site controller
 */
class SiteController extends Controller implements ViewContextInterface
{
    public function init(){
        /* Установка шаблона относительно устройства входа */
        $enterDevice = MobileDetector::getDevice();
        $this->getView()->theme = Yii::createObject([
            'class' => '\yii\base\Theme',
            'pathMap' => ['@frontend/views' => Yii::getAlias('@frontend/templates/base/'.$enterDevice)],
        ]);

        /* Если нужно задать язык который выбрал пользователь, а не из настроек */
        //\Yii::$app->language = 'en-US';
    }

    /*
     * Установка пути для Vievs данного компонента
     */
    public function getViewPath()
    {
        return \common\libs\Core\controllers\CoreController::getComponentViewPath(__DIR__);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
//            'rateLimiter' => [
//                'class' => \yii\filters\RateLimiter::className(),
////                'only' => ['index'],
//                'enableRateLimitHeaders' => true,
//                'errorMessage' => 'Превышен лимит обращений',
//            ],

//            'pageCache' => [
//                'class' => 'yii\filters\PageCache',
////                'only' => ['index'],
//                'duration' => 60,
//                'variations' => [
//                    \Yii::$app->language,
//                ],
//                'dependency' => [
//                    'class' => 'yii\caching\DbDependency',
//                    'sql' => 'SELECT COUNT(*) FROM feq2d_page',
//                ],
//            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex($path = null, $id = null)
    {
        // Задание шаблона
//        $this->getView()->theme = Yii::createObject([
//            'class' => '\yii\base\Theme',
//            'pathMap' => ['@frontend/views' => Yii::getAlias('@webroot/templates/base/mobile')],
//            'baseUrl' => Yii::getAlias('@webroot/templates/base/mobile'),
//        ]);
        return $this->render('index', [
            'path' => $path,
            'id' => $id,
        ]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
