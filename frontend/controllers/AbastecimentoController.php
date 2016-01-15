<?php

namespace frontend\controllers;

use frontend\models\TipoCombustivel;
use frontend\models\Usuario;
use mPDF;
use Yii;
use frontend\models\Abastecimento;
use frontend\models\AbastecimentoSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\user;

/**
 * AbastecimentoController implements the CRUD actions for Abastecimento model.
 */
class AbastecimentoController extends Controller
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
        ];

    }

    /**
     * Lists all Abastecimento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AbastecimentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Abastecimento model.
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
     * Creates a new Abastecimento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Abastecimento();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Abastecimento salvo com sucesso.');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Abastecimento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Abastecimento alterado com sucesso.');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Abastecimento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Abastecimento excluído com sucesso.');
        }
        else {
            Yii::$app->session->setFlash('error', 'Não foi possível excluir o abastecimento.');
        }
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCalculo($id, $valor_abastecido){
        //$this->id_combustivel = TipoCombustivel::findOne($this->id_combustivel)->nome;
        echo $valor_abastecido /TipoCombustivel::findOne($id)->preco_litro;
        //echo "Valor: $valor_abastecido ID: .$id";

    }


    /**
     * Finds the Abastecimento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Abastecimento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Abastecimento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionPdf($data_inicio, $data_fim) {

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
        $relatorio = "RELATÓRIO DE GASTOS COM ABASTECIMENTOS";

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
             <th>Posto</th>
             <th>Tipo do Combustível</th>
             <th>Valor Abastecido</th>
             <th>Veículo</th>
             <th>Motorista</th>
             <th>Data do Abastecimento</th>
           </tr>";

        $connection = \Yii::$app->db;
        $sql = "SELECT * FROM abastecimento WHERE data_abastecimento BETWEEN $data_inicio AND $data_fim";
        $model = $connection->createCommand($sql);
        $users = $model->queryAll();

        foreach ($users as $reg):
            $retorno .= ($color) ? "<tr>" : "<tr class=\"zebra\">";
            $retorno .= "<td>{$reg['id_posto']}</td>";
            $retorno .= "<td>{$reg['id_combustivel']}</td>";
            $retorno .= "<td>{$reg['valor_abastecido']}</td>";
            $retorno .= "<td>{$reg['id_veiculo']}</td>";
            $retorno .= "<td>{$reg['id_motorista']}</td>";
            $retorno .= "<td>{$reg['data_abastecimento']}</td>";
            $retorno .= "<tr>";
            $color = !$color;
        endforeach;

        $retorno .= "</table>";
        return $retorno;
    }


}
