<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PostoAbastecimentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Postos de Abastecimento';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posto-abastecimento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p align="right">
        <?= Html::a('Novo Posto de Abastecimento', ['create'], ['class' => 'btn btn-success']) ?>
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
                'endereco',

                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{visualizar}  {editar}  {excluir}',
                    'buttons' => [
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
