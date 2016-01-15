<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use frontend\models\Modelo;
use frontend\models\Marca;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ModeloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $modelo frontend\models\Modelo */
if(Yii::$app->session->hasFlash('success')) {
    echo '<br>';
    echo "<div class='alert alert-success' data-dismiss='alert'>";
    //echo "<div class='alert alert-success close' data-dismiss='alert' aria-hidden='true'>";
    echo Yii::$app->session->getFlash('success');
    echo "</div>";
}
if(Yii::$app->session->hasFlash('error')) {
    echo '<br>';
    echo "<div class='alert alert-error' data-dismiss='alert'>";
    //echo "<div class='alert alert-success close' data-dismiss='alert' aria-hidden='true'>";
    echo Yii::$app->session->getFlash('error');
    echo "</div>";
}

$this->title = 'Modelos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modelo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p align="right">
        <?= Html::a('Novo Modelo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box box-primary">
        <div class="box-header with-border">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'nome',
                    //'ano',
                    [
                        'attribute' => 'id_marca',
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'id_marca',
                            ArrayHelper::map(Marca::find()->asArray()->all(), 'id', 'nome'),
                            ['class'=>'form-control','prompt'=>'Filtrar'  ]),
                    ],
                    //'id_marca',

                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{visualizar}  {editar}  {excluir}',
                        'buttons' => [
                            'visualizar' => function($url,$model) {
                                $model->id_marca = Modelo::findOne($model->id)->idMarca;
                                return Html::a(
                                    '<span class="fa fa-eye"></span>',
                                    ['view', 'id' => $model->id],
                                    [
                                        //'class' => 'btn btn-default',
                                        'title' => 'Exibir',
                                        'data-pjax' => '0',
                                    ]
                                );
                            },
                            'editar' => function($url,$model) {
                                return Html::a(
                                    '<span class="fa fa-pencil"></span>',
                                    ['update', 'id' => $model->id],
                                    [
                                        //'class' => 'btn btn-default',
                                        'title' => 'Alterar',
                                        'data-pjax' => '0',
                                    ]
                                );
                            },
                            'excluir' => function($url,$model) {
                                return Html::a(
                                    '<span class="fa fa-trash"></span>',
                                    ['delete', 'id' => $model->id], [
                                        //'class' => 'btn btn-default',
                                        'title' => 'Excluir',
                                        'data-pjax' => '0',
                                        'data' => [
                                            'confirm' => 'Tem certeza de que deseja excluir este item?',
                                            'method' => 'post',
                                        ],
                                    ]
                                );
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>

</div>