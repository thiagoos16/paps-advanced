<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TipoCombustivelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo de Combustível';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-combustivel-index">
    <?php
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
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Novo Tipo de Combustível', ['create'], ['class' => 'btn btn-success']) ?>
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

                    //['class' => 'yii\grid\ActionColumn'],
                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{meses} {visualizar} {editar} {excluir}',
                        'buttons' => [
                            'meses' => function($url,$model) {
                                return Html::a(
                                    '<span class="fa fa-dollar"></span>',
                                    ['combustivel-mes/index', 'id' => $model->id],
                                    [
                                        //'class' => 'btn btn-default',
                                        'title' => 'Preço por Mês',
                                        'data-pjax' => '0',
                                    ]
                                );
                            },
                            'visualizar' => function($url,$model) {
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
