<?php

use frontend\models\Motorista;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MotoristaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
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

$this->title = 'Motoristas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="motorista-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p align="right">
        <?= Html::a('Novo Motorista', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a ('Gerar PDF', ['pdf'], ['class' => 'btn btn-warning', 'target' => '_blank']) ?>
    </p>

    <div class="box box-primary">
        <div class="box-header with-border">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'nome',
                'cnh',
                'categoria_cnh',
                /*[
                    'attribute' => 'categoria_cnh',
                    'filter' => Html::activeDropDownList($searchModel, 'categoria_cnh', Motorista::getCategoria(),['class'=>'form-control','prompt'=>'Filtrar'  ]),
                ],*/
                //'tipo',
                //'status',
                [
                    'attribute' => 'tipo',
                    'filter' => Html::activeDropDownList($searchModel, 'tipo', Motorista::getTipo(),['class'=>'form-control','prompt'=>'Filtrar']),
                ],
                // 'telefone',

                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{visualizar}  {editar}  {excluir}',
                    'buttons' => [
                        'visualizar' => function($url,$model) {
                            return Html::a(
                                '<span class="fa fa-eye"></span>',
                                ['view', 'id' => $model->cnh],
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
                                ['update', 'id' => $model->cnh],
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
                                ['delete', 'id' => $model->cnh], [
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
