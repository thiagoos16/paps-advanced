<?php

use frontend\models\CombustivelMes;
use frontend\models\TipoCombustivel;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CombustivelMesSearch */
/* @var $model frontend\models\CombustivelMes*/
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Combustível Mes';
$this->params['breadcrumbs'][] = ['label' => 'Combustivel', 'url' => ['tipo-combustivel/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="combustivel-mes-index">

    <h1><?= Html::encode("Histórico de preços: ".TipoCombustivel::findOne($id)->nome) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Novo Preço do Combustível', ['create','id'=>$id], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="box box-primary">
        <div class="box-header with-border">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id_combustivel',
                    [
                        'attribute' => 'mes',
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'mes',
                            CombustivelMes::getMes(),
                            ['class'=>'form-control','prompt'=>'Filtrar'  ]),
                    ],
                    'ano',

                    'valor',

                    //['class' => 'yii\grid\ActionColumn'],
                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{visualizar} {editar} {excluir}',
                        'buttons' => [
                            'visualizar' => function($url,$model) {
                                return Html::a(
                                    '<span class="fa fa-eye"></span>',
                                    [
                                        'view',
                                        'id_combustivel' => $model->id_combustivel,
                                        'mes' => $model->mes_bkp,
                                        'ano' => $model->ano
                                    ],

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
                                        [
                                            'update',
                                            'id_combustivel' => $model->id_combustivel,
                                            'mes' => $model->mes_bkp,
                                            'ano' => $model->ano
                                        ],
                                        ['delete'],
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
                                        [
                                            'delete',
                                            'id_combustivel' => $model->id_combustivel,
                                            'mes' => $model->mes_bkp,
                                            'ano' => $model->ano
                                        ],

                                        [
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
                    ]
                ],
            ]); ?>
        </div>
    </div>

</div>
