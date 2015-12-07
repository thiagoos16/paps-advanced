<?php

namespace frontend\controllers;

use frontend\models\TipoCombustivel;
use frontend\models\Usuario;
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
        $this->findModel($id)->delete();

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
}
