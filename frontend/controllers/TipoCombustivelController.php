<?php

namespace frontend\controllers;

use frontend\models\TipoCombustivel;
use frontend\models\TipoCombustivelSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use frontend\models\user;
use frontend\models\Usuario;

/**
 * TipoCombustivelController implements the CRUD actions for TipoCombustivel model.
 */
class TipoCombustivelController extends Controller
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
     * Lists all TipoCombustivel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TipoCombustivelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TipoCombustivel model.
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
     * Creates a new TipoCombustivel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TipoCombustivel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Tipo de Combustível salvo com sucesso.');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TipoCombustivel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Tipo de Combustível alterado com sucesso.');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TipoCombustivel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Combustível excluído com sucesso.');
        }
        else {
            Yii::$app->session->setFlash('error', 'O combustível não pode ser excluído pois possui relação com um ou mais veículos.');
        }

        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TipoCombustivel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TipoCombustivel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TipoCombustivel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
