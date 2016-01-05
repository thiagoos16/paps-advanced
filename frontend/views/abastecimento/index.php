<?php

use frontend\models\TipoCombustivel;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AbastecimentoSearch */
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

$this->title = 'Abastecimentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="abastecimento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p align="right">
        <?= Html::a('Novo Abastecimento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box box-primary">
        <div class="box-header with-border">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'posto',
                        'value' => 'idPosto.nome',
                    ],
                    [
                        'attribute' => 'id_veiculo',
                        'value' => 'idVeiculo.placa_atual'
                    ],
                    [
                        'attribute' => 'id_combustivel',
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'id_combustivel',
                            ArrayHelper::map(TipoCombustivel::find()->asArray()->all(), 'id', 'nome'),
                            ['class'=>'form-control','prompt'=>'Filtrar'  ]),
                    ],

                    'qty_litro',
                    // 'data_lancamento',
                    // 'id_motorista',
                    // 'data_abastecimento',

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
