<?php

namespace frontend\controllers;

use mPDF;
use Yii;
use frontend\models\Manutencao;
use frontend\models\ManutencaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\user;
use frontend\models\Usuario;

/**
 * ManutencaoController implements the CRUD actions for Manutencao model.
 */
class ManutencaoController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','index','update','view','delete'],
                'rules' => [
                    array(
                        'allow' => true,
                        'actions' => ['create','index','update','view','delete'],
                        'matchCallback' => function($rule,$action) {
                            if (!Yii::$app->user->isGuest) {
                                return Usuario::findOne(Yii::$app->getUser()->id)->id_departamento == "1";
                            }
                        }
                    ),
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
     * Lists all Manutencao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ManutencaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Manutencao model.
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
     * Creates a new Manutencao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Manutencao();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Manutenção salva com sucesso.');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Manutencao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Manutenção alterada com sucesso.');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Manutencao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Manutenção excluída com sucesso.');
        }
        else {
            Yii::$app->session->setFlash('error', 'Não foi possível excluir a manutenção.');
        }
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Manutencao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Manutencao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Manutencao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPdf($data_inicio, $data_fim) {

        $data_inicio = str_replace("'","",$data_inicio);
        $data_fim = str_replace("'","",$data_fim);
        $data_inicio = date("Y-m-d", strtotime($data_inicio));
        $data_fim = date("Y-m-d", strtotime($data_fim));

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
        $mpdf->WriteHTML($this->getTabela($data_inicio, $data_fim));

        $mpdf->Output();
        exit;
    }

    //------------------------------------GErando PDF ----------------------
    private function getTabela($data_inicio, $data_fim){

        $color  = false;
        $retorno = "";
        date_default_timezone_set('America/Manaus');
        $data = date("d/m/Y");
        $hora = date("H:i");
        $relatorio = "RELATÓRIO DE GASTOS COM MANUTENÇÕES";

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
             <th>Data de Entrada</th>
             <th>Serviço</th>
             <th>Custo R$</th>
             <th>Data de Saída</th>
             <th>Veículo</th>
             <th>Placa</th>
             <th>Motorista</th>
           </tr>";

        $connection = \Yii::$app->db;
        $sql = "SELECT * FROM manutencao WHERE data_entrada BETWEEN '$data_inicio' AND '$data_fim' ORDER BY data_entrada ASC";
        $model = $connection->createCommand($sql);
        $users = $model->queryAll();

        foreach ($users as $reg):
            $retorno .= ($color) ? "<tr>" : "<tr class=\"zebra\">";

            //DATA DE ENTRADA
            $reg['data_entrada'] = date("d-m-Y", strtotime($reg['data_entrada']));
            $retorno .= "<td>{$reg['data_entrada']}</td>";

            //SERVICO
            $retorno .= "<td>{$reg['servico']}</td>";

            //CUSTO
            $retorno .= "<td>{$reg['custo']}</td>";

            //DATA DE SAIDA
            $retorno .= "<td>{$reg['data_saida']}</td>";


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


            //MOTORISTA
            $id_motorista = "{$reg['id_motorista']}";
            $modelMotorista = $connection->createCommand("SELECT nome FROM motorista WHERE cnh = '$id_motorista'");
            $motoristas = $modelMotorista->queryAll();
            foreach ($motoristas as $motorista):
                $nome_motorista = "{$motorista['nome']}";
            endforeach;
            $retorno .= "<td>$nome_motorista</td>";


            $retorno .= "<tr>";
            $color = !$color;
        endforeach;

        $retorno .= "</table>";
        return $retorno;
    }
}
