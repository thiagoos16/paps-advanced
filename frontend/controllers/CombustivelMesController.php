<?php

namespace frontend\controllers;

use Yii;
use frontend\models\CombustivelMes;
use frontend\models\CombustivelMesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CombustivelMesController implements the CRUD actions for CombustivelMes model.
 */
class CombustivelMesController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all CombustivelMes models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new CombustivelMesSearch();
        $searchModel->id_combustivel = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id'=> $id
        ]);
    }

    /**
     * Displays a single CombustivelMes model.
     * @param integer $id_combustivel
     * @param integer $mes
     * @param integer $ano
     * @return mixed
     */
    public function actionView($id_combustivel, $mes, $ano)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_combustivel, $mes, $ano),
        ]);
    }

    /**
     * Creates a new CombustivelMes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new CombustivelMes();
        $model->id_combustivel = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_combustivel' => $model->id_combustivel, 'mes' => $model->mes, 'ano' => $model->ano]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CombustivelMes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_combustivel
     * @param integer $mes
     * @param integer $ano
     * @return mixed
     */
    public function actionUpdate($id_combustivel, $mes, $ano)
    {
        $model = $this->findModel($id_combustivel, $mes, $ano);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_combustivel' => $model->id_combustivel, 'mes' => $model->mes, 'ano' => $model->ano]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CombustivelMes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_combustivel
     * @param integer $mes
     * @param integer $ano
     * @return mixed
     */
    public function actionDelete($id_combustivel, $mes, $ano)
    {
        $this->findModel($id_combustivel, $mes, $ano)->delete();

        return $this->redirect(['index', 'id' => $id_combustivel]);
    }

    /**
     * Finds the CombustivelMes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_combustivel
     * @param integer $mes
     * @param integer $ano
     * @return CombustivelMes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_combustivel, $mes, $ano)
    {
        if (($model = CombustivelMes::findOne(['id_combustivel' => $id_combustivel, 'mes' => $mes, 'ano' => $ano])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
