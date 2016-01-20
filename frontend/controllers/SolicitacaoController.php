<?php

namespace frontend\controllers;

use mPDF;
use Yii;
use frontend\models\Solicitacao;
use frontend\models\SolicitacaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\Usuario;

/**
 * SolicitacaoController implements the CRUD actions for Solicitacao model.
 */
class SolicitacaoController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','index','update','view','delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create','index','update','view'],
                        'matchCallback' => function($rule,$action) {
                            if (!Yii::$app->user->isGuest) {
                                return Usuario::findOne(Yii::$app->getUser()->id)->id_departamento == "1";
                            }
                        }
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','view'],
                        'matchCallback' => function($rule,$action) {
                            if (!Yii::$app->user->isGuest) {
                                return Usuario::findOne(Yii::$app->getUser()->id)->id_departamento != "1";
                            }
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Solicitacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SolicitacaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Solicitacao model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Solicitacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Solicitacao();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Solicitação salva com sucesso.');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Solicitacao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Solicitação alterada com sucesso.');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionResposta($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Resposta salva com sucesso.');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('updateResposta', [
                'model' => $model,
            ]);
        }
    }

    public function actionRejeitar($id)
    {
        Solicitacao::updateAll(array('status' => 'Rejeitada'), ['id'=> $id]);

        $searchModel = new SolicitacaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing Solicitacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Solicitação excluída com sucesso.');
        }
        else {
            Yii::$app->session->setFlash('error', 'Não foi possível excluir a solicitação');
        }
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionVisualiza($id){

        Solicitacao::updateAll(array('notification' => 1), ['id' => $id]);
        return $this->redirect(['view', 'id' => $id]);

    }

    /**
     * Finds the Solicitacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Solicitacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Solicitacao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPdf($data_inicio) {

        $data_inicio = str_replace("'","",$data_inicio);
        $data_inicio = date("Y-m-d", strtotime($data_inicio));

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
        $mpdf->WriteHTML($this->getTabela($data_inicio));

        $mpdf->Output();
        exit;
    }
    //------------------------------------GErando PDF ----------------------
    private function getTabela($data_inicio){
        $color  = false;
        $retorno = "";
        date_default_timezone_set('America/Manaus');
        $data = date("d/m/Y");
        $hora = date("H:i");
        $relatorio = "Solicitações do dia ";

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
           <tr class='thDados'>
             <th>Solicitante</th>
             <th>Horário Saída</th>
             <th>Destino</th>
             <th>Motorista</th>
             <th>Veículo</th>
             <th>Placa</th>
             <th>Observação</th>
           </tr>";


        $connection = \Yii::$app->db;
        $model = $connection->createCommand("SELECT * FROM solicitacao WHERE status = 'Aceita' AND data_saida = '$data_inicio'");
        $users = $model->queryAll();

        foreach ($users as $reg):
            $retorno .= ($color) ? "<tr>" : "<tr class=\"zebra\">";

            //SOLICITANTE
            $id_usuario = "{$reg['id_usuario']}";
            $modelUsuario = $connection->createCommand("SELECT nome FROM user WHERE id = '$id_usuario'");
            $usuarios = $modelUsuario->queryAll();
            foreach ($usuarios as $usuario):
                $nome_usuario = "{$usuario['nome']}";
            endforeach;
            $retorno .= "<td>$nome_usuario</td>";

            //HORARIO DA SAIDA
            $retorno .= "<td>{$reg['hora_saida']}</td>";

            //DESTINO
            $retorno .= "<td>{$reg['destino']}</td>";

            //MOTORISTA
            $id_motorista = "{$reg['id_motorista']}";
            $modelMotorista = $connection->createCommand("SELECT nome FROM motorista WHERE cnh = '$id_motorista'");
            $motoristas = $modelMotorista->queryAll();
            foreach ($motoristas as $motorista):
                $nome_motorista = "{$motorista['nome']}";
            endforeach;
            $retorno .= "<td>$nome_motorista</td>";

            //MODELO DO VEÍCULO
            $id_veiculo = "{$reg['id_veiculo']}";
            $modelVeiculoModelo = $connection->createCommand("SELECT nome FROM modelo WHERE modelo.id = (SELECT id_modelo FROM veiculo WHERE renavam = '$id_veiculo')");
            $veiculosModelo = $modelVeiculoModelo->queryAll();
            foreach ($veiculosModelo as $veiculoModelo):
                $modelo_veiculo = "{$veiculoModelo['nome']}";
            endforeach;
            $retorno .= "<td>$modelo_veiculo</td>";

            //PLACA DO VEÍCULO
            $modelVeiculoPlaca = $connection->createCommand("SELECT placa_atual FROM veiculo WHERE renavam = '$id_veiculo'");
            $veiculosPlaca = $modelVeiculoPlaca->queryAll();
            foreach ($veiculosPlaca as $veiculoPlaca):
                $placa_veiculo = "{$veiculoPlaca['placa_atual']}";
            endforeach;
            $retorno .= "<td>$placa_veiculo</td>";

            //DESTINO
            $retorno .= "<td>{$reg['observacao']}</td>";

            $retorno .= "<tr>";
            $color = !$color;
        endforeach;

        $retorno .= "</table>";
        return $retorno;
    }
}
