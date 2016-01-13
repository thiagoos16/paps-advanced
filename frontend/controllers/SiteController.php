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
use yii\base\ErrorException;
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

        $mpdf = new mPDF('',    // mode - default ''
            '',    // format - A4, for example, default ''
            0,     // font size - default 0
            '',    // default font family
            15,    // margin_left
            15,    // margin right
            16,     // margin top
            16,    // margin bottom
            9,     // margin header
            9,     // margin footer

            'L');
        $stylesheet = file_get_contents("./../web/css/relatorios.css");

        $mpdf->AddPage('L');
        $mpdf->WriteHTML($stylesheet,1);


        $sql = "SELECT veiculo.renavam, veiculo.cidade, veiculo.chassi, veiculo.potencia, veiculo.placa_anterior,
veiculo.placa_atual, veiculo.cidade, veiculo.uf_anterior, veiculo.uf_atual,
veiculo.num_patrimonio, veiculo.lotacao, veiculo.ano_modelo,

modelo.nome as nome_modelo, marca.nome as nome_marca,
cor.nome as nome_cor,
tipo_combustivel.nome as nome_combustivel
FROM veiculo
INNER JOIN modelo ON veiculo.id_modelo = modelo.id
INNER JOIN marca ON modelo.id = marca.id
INNER JOIN cor on veiculo.id_cor = cor.id
INNER join tipo_combustivel on veiculo.id_tipo_combustivel = tipo_combustivel.id
";

        $connection = \Yii::$app->db;
        $model = $connection->createCommand($sql);
        $veiculos_lista = $model->queryAll();

        foreach ($veiculos_lista as $veiculo):
            $mpdf->WriteHTML($this->getTabela($veiculo));
        endforeach;

        $mpdf->Output();
        exit;
    }

    //------------------------------------GErando PDF ----------------------
    /**
     * @param $veiculo
     * @return string
     */
    private function getTabela($veiculo){
        $ano = date("Y");
        $color  = false;
        $retorno = "";
        date_default_timezone_set('America/Manaus');
        $data = date("d/m/Y");
        $hora = date("H:i");
        $relatorio = "RELATÓRIO ANUAL";

        $sql2 = "SELECT abastecimento.data_abastecimento,
                  Month(abastecimento.data_abastecimento) as mes,
                  YEAR(abastecimento.data_lancamento) as ano,

                  MAX(abastecimento.km) - MIN(abastecimento.km) as km_mes,
                    SUM(abastecimento.qty_litro) as litro_mes,
                    abastecimento.id_veiculo
                    from abastecimento

                    GROUP BY abastecimento.id_veiculo, mes
                    HAVING ano = 2016 AND abastecimento.id_veiculo = ".$veiculo['renavam'];

        $connection = \Yii::$app->db;
        $model = $connection->createCommand($sql2);
        $gastos_lista = $model->queryAll();

        $retorno .= "<hr><table class='cabecalho'>
           <tr>
             <td><img src='./../web/css/ufam.png' width='70px' height='70px'></td>
             <td>
                <p>
                <b>UNIVERSIDADE FEDERAL DO AMAZONAS</b></p><br>
			    <p>
			        PREFEITURA DO CAMPUS UNIVERSITÁRIO<br>
			        COORDENAÇÃO DE TRANSPORTE
			    </p>
             </td>
             <td><b>
             <p>Data:   $data</p>
             <p>Hora:   $hora</p>
             </b></td>
           </tr>";
        $retorno .= "</table><hr>";
        $retorno .= "<h2 align='center'>$relatorio</h2>";
        $retorno .= "<table class='tableDados'>
    <tr class='zebra'>
        <td colspan='3'>SERVIÇO PÚBLICO FEDERAL</td>
        <td colspan='3'>MINISTÉRIO / ÓRGÃO / ENTIDADE</td>
        <td colspan='3'>ANO</td>
    </tr>

    <tr>
        <td colspan='3'>SISTEMA DE SERVIÇOS GERAIS - SISG </td>
        <td colspan='3'>FUNDAÇÃO UNIVERSIDADE DO AMAZONAS </td>
        <td colspan='3'>$ano</td>
    </tr>

    <tr class='zebra'>
        <td colspan='3'> MARCA / TIPO MODELO</td>
        <td colspan='3'>COR</td>
        <td colspan='3'>ANO DE FABRICAÇÃO</td>
    </tr>

    <tr>
        <td colspan='3'>".strtoupper($veiculo['nome_marca']." / ".$veiculo['nome_modelo'])."</td>
        <td colspan='3'>".strtoupper($veiculo['nome_cor'])."</td>
        <td colspan='3'>".$veiculo['ano_modelo']."</td>
    </tr>

    <tr class='zebra'>
        <td colspan='3'>GRUPO</td>
        <td colspan='3'>COMBUSTÍVEL</td>
        <td colspan='3'>PATRIMONIO</td>
    </tr>

    <tr>
        <td colspan='3'> SERVIÇOS COMUNS </td>
        <td colspan='3'>".strtoupper($veiculo['nome_combustivel'])."</td>
        <td colspan='3'>".$veiculo['num_patrimonio']."</td>
    </tr>

    <tr class='zebra'>
        <td colspan='4'>PLACA ANTERIOR</td>
        <td>UF</td>
        <td colspan='3'>LOCALIZAÇÃO(MUNICÍPIO)</td>
        <td>UF</td>
    </tr>

    <tr>
        <td colspan='4'>".strtoupper($veiculo['placa_anterior']==""? " - ":$veiculo['placa_anterior'])." </td>
        <td>".strtoupper($veiculo['uf_anterior']==""? " - ":$veiculo['uf_anterior'])."</td>

        <td colspan='3'>".strtoupper($veiculo['cidade'])."</td>
        <td>".strtoupper($veiculo['uf_anterior']==""? " - ":$veiculo['uf_anterior'])."</td>
    </tr>

    <tr class='zebra'>
        <td colspan='4'>PLACA ATUAL</td>
        <td>UF</td>
        <td colspan='3'>LOCALIZAÇÃO(MUNICÍPIO)</td>
        <td>UF</td>
    </tr>

    <tr>
        <td colspan='4'>".strtoupper($veiculo['placa_atual'])."</td>
        <td>".strtoupper($veiculo['uf_atual'])."</td>

        <td colspan='3'>".strtoupper($veiculo['cidade'])."</td>
        <td>".strtoupper($veiculo['uf_atual'])."</td>
    </tr>

    <tr class='zebra'>
        <td colspan='3'>CHASSI</td>
        <td colspan='3'>HP</td>
        <td colspan='3'>CÓDIGO RENAVAM</td>
    </tr>

    <tr>
        <td colspan='3'>".strtoupper($veiculo['chassi'])."</td>
        <td colspan='3'>".strtoupper($veiculo['potencia'])."</td>
        <td colspan='3'>".strtoupper($veiculo['renavam'])."</td>
    </tr>

    <tr class='zebra'>
        <td rowspan='2'>MÊS</td>
        <td rowspan='2'>KM RODADO NO MÊS</td>
        <td rowspan='2'>CONSUMO DE COMBUSTÍVEL POR LITRO</td>
        <td rowspan='2'>KM RODADO POR LITRO</td>
        <td colspan='3'>VALOR DESPESA (R$)</td>
        <td rowspan='2'>TOTAL (R$)</td>
        <td rowspan='2'>MÉDIA POR KM RODADO (R$)</td>
    </tr>
    <tr class='zebra'>
        <td>COMBUSTIVEL</td>
        <td>MANUTENÇÃO/CONSERVAÇÃO</td>
        <td>REPAROS</td>
    </tr>";
    $i=0;
    $lista=[];
    $km_litro = 0;
    foreach ($gastos_lista as $gasto):
        $lista[$i]["mes"] = $gasto['mes'];
        $lista[$i]["km_mes"] = $gasto['km_mes'];
        $lista[$i]["litro_mes"] = $gasto['litro_mes'];
    $i++;
    endforeach;

    try {
        $km_litro_jan = round($lista[0]['km_mes'] / $lista[0]['litro_mes'],2);
        $km_litro_fev = round($lista[1]['km_mes'] / $lista[1]['litro_mes'],2);
    }catch(ErrorException $e){
        $km_litro_jan = 0.0;
    }

    $retorno .= "<tr>
        <td>JAN</td>
        <td>".$lista[0]['km_mes']."</td>
        <td>".round($lista[0]['litro_mes'],2)."</td>
        <td>".$km_litro_jan."</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
    <tr class='zebra'>
        <td>FEV</td>
        <td>". $lista[1]['km_mes']."</td>
        <td>". round($lista[1]['litro_mes'],2)."</td>
        <td>".$km_litro_fev."</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
    <tr>
        <td>MAR</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
    <tr class='zebra'>
        <td>ABR</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
    <tr>
        <td>MAI</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
    <tr class='zebra'>
        <td>JUN</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
    <tr>
        <td>JUL</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
    <tr class='zebra'>
        <td>AGO</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
    <tr>
        <td>SET</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
    <tr class='zebra'>
        <td>OUT</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
    <tr>
        <td>NOV</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
    <tr class='zebra'>
        <td>DEZ</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>";

        $retorno .= "</table>";
        return $retorno;
    }
}
