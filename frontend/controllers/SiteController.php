<?php
namespace frontend\controllers;

use common\models\LockscreenForm;
use frontend\models\Motorista;
use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use frontend\models\Departamento;

#We will include the pdf library installed by composer
use mPDF;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],

//                    [
//                        'actions' => ['logout', 'index'],
//                        'allow' => true,
 //                       'roles' => ['@'],
//                    ],
                ],
            ],

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

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $connection = \Yii::$app->db;
        $model = $connection->createCommand("SELECT * FROM motorista");
        $events = $model->queryAll();

        $eve = [];

        foreach($events as $even):
            $event = new \yii2fullcalendar\models\Event();
            $event->id = "{$even['cnh']}";
            $cnh = "{$even['cnh']}";
            $event->title =  "Vencimento de CNH";
            $event->start = "{$even['data_validade_cnh']}";
            $event->backgroundColor = "#FF6347";
            $event->borderColor = "#FF6347";
            $event->url = "index.php?r=motorista%2Fview&id=$cnh";
            $eve[] = $event;
        endforeach;

        $model = $connection->createCommand("SELECT * FROM solicitacao WHERE status='Aceita'");
        $solicitacoes = $model->queryAll();

        foreach($solicitacoes as $s):
            $solicitacao = new \yii2fullcalendar\models\Event();
            $solicitacao->id = "{$s['id']}";
            $id = "{$s['id']}";
            $solicitacao->title = "Solicitação Aceita";
            $solicitacao->start = "{$s['data_saida']}";
            $solicitacao->backgroundColor = "#FFD700";
            $solicitacao->borderColor = "#FFD700";
            //$solicitacao->
            $solicitacao->url = "index.php?r=solicitacao%2Fview&id=$id";
            $eve[] = $solicitacao;
        endforeach;


        return $this->render('index', ['events' => $eve]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout = 'guest';

        /*
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }*/

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
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

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $departamento = ArrayHelper::map(Departamento::find()->all(), 'id', 'nome');

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model, 'departamento_lista'=>$departamento,
        ]);
    }

    public function actionLockscreen()
    {
        $this->layout = 'guest';

        $model = new LockscreenForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->layout = 'main';
            return $this->render('index');
        } else {
            $model->password = '';
            return $this->render('lockscreen', ['model' => $model]);
        }
    }


        /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $this->layout = 'guest';

        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionPdf() {

        $mpdf = new mPDF;
        $mpdf->WriteHTML('<p>Hallo World</p>');
        $mpdf->Output();
        exit;
    }
}
