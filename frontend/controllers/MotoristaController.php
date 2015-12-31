<?php

namespace frontend\controllers;

use yii\db\Query;
use mPDF;
use Yii;
use frontend\models\Motorista;
use frontend\models\MotoristaSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use frontend\models\user;
use frontend\models\Usuario;

/**
 * MotoristaController implements the CRUD actions for Motorista model.
 */
class MotoristaController extends Controller
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
     * Lists all Motorista models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MotoristaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Motorista model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Motorista model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Motorista();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Motorista salvo(a) com sucesso.');
            return $this->redirect(['view', 'id' => $model->cnh]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Motorista model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
       $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Motorista alterado(a) com sucesso.');
            return $this->redirect(['view', 'id' => $model->cnh]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Motorista model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Motorista excluído(a) com sucesso.');
        }
        else {
            Yii::$app->session->setFlash('error', 'O(A) motorista não pode ser excluído(a) pois possui relação com uma ou mais solicitações.');
        }

        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Motorista model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Motorista the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Motorista::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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
        $stylesheet = file_get_contents("./../web/css/site.css");

        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($this->getTabela());

        $mpdf->Output();
        exit;
    }
    public $titulo = "Relatório de Motoristas";
    //------------------------------------GErando PDF ----------------------
    private function getTabela(){
        $color  = false;
        $retorno = "";

        $retorno .= "<h2 style=\"text-align:center\">{$this->titulo}</h2>";
        $retorno .= "<table border='1' width='1000' align='center'>
           <tr class='header'>
             <th>Nome</td>
             <th>Categoria</td>
             <th>Data de Validade</td>
             <th>Tipo</td>
             <th>Status</td>
             <th>Telefone</td>
             <th>CNH</td>
           </tr>";

        $connection = \Yii::$app->db;
        $model = $connection->createCommand('SELECT * FROM motorista');
        $users = $model->queryAll();

        foreach ($users as $reg):
            $retorno .= ($color) ? "<tr>" : "<tr class=\"zebra\">";
            $retorno .= "<td>{$reg['nome']}</td>";
            $retorno .= "<td>{$reg['categoria_cnh']}</td>";
            $retorno .= "<td>{$reg['data_validade_cnh']}</td>";
            $retorno .= "<td>{$reg['tipo']}</td>";
            $retorno .= "<td>{$reg['status']}</td>";
            $retorno .= "<td>{$reg['telefone']}</td>";
            $retorno .= "<td>{$reg['cnh']}</td>";
            $retorno .= "<tr>";
            $color = !$color;
        endforeach;

        $retorno .= "</table>";
        return $retorno;
    }


}
