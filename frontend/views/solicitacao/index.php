<?php

use dosamigos\datepicker\DatePicker;
use frontend\models\Modelo;
use frontend\models\Solicitacao;
use frontend\models\Usuario;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SolicitacaoSearch */
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


$this->title = 'Solicitações';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p align="right">
        <?= Html::a('Nova Solicitação', ['create'], ['class' => 'btn btn-success']) ?>
        <?php
            if(Usuario::findOne(Yii::$app->getUser()->id)->id_departamento == 1) {
                echo "<button id = 'exibirfiltro' class='btn btn-warning' onclick = 'exibirfiltro()' > Solicitações do dia </button >";
            }
        ?>
    </p>

    <div class="box box-primary"  style = "display: none" id="formfiltro">
        <div class="box-header with-border">
            <b>Resumo de Solicitações do dia:</b><br><br>
            <?= DatePicker::widget([
                'id' => 'dataInicio',
                'name' => 'DataEntrada',
                'template' => '{addon}{input}',
                'language' => 'pt',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy'
                ]
            ]);?>
            <br>

            <button class="btn btn-warning" onclick="pegardata()">Gerar PDF</button>

        </div>
    </div>


    <div class="box box-primary">
        <div class="box-header with-border">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'destino',
                    [
                        'attribute' => 'veiculo',
                        'value' => 'idVeiculo.placa_atual',
                    ],
                    [
                        'attribute' => 'modelo',
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'modelo',
                            ArrayHelper::map(Modelo::find()->asArray()->all(), 'id', 'nome'),
                            ['class'=>'form-control','prompt'=>'Filtrar'  ]),
                        'value' => 'idVeiculo.idModelo.nome',
                    ],
                    //'data_saida',
                    //'hora_saida',
                    //'data_lancamento',
                    // 'observacao',
                    [
                        'attribute' => 'status',
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'status',
                            Solicitacao::getStatus(),['class'=>'form-control','prompt'=>'Filtrar']),
                    ],
                    //[
                        //'attribute' => 'user',
                        'idUsuario.idDepartamento.nome',
                    //],
                    // 'capacidade_passageiros',
                    // 'endeeco_destino',
                    // 'hora_chegada',
                    // 'id_motorista',
                    // 'id_veiculo',
                    // 'seguro',

                    ['class' => 'yii\grid\ActionColumn',                        
						'template' => '{visualizar}  {excluir}',                        
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
								if($model->status == "Aceita"){
                                return Html::a(
                                    '<span class="fa fa-pencil"></span>',
                                    ['update', 'id' => $model->id],
                                    [
                                        //'class' => 'btn btn-default',
                                        'title' => 'Alterar',
                                        'data-pjax' => '0',
                                    ]
                                );
								}
                            },
                            'excluir' => function($url,$model) {
								if($model->status != "Aceita"){
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
								}
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>

<script>

    function exibirfiltro(){
        var form = document.querySelector('#formfiltro');
        if(form.style.display == "block"){
            form.style.display = "none";
        }else{
            form.style.display = "block";
        }
    }

    function pegardata(){
        var inicio = document.querySelector('#dataInicio');
        var url = "<?= Yii::$app->getHomeUrl()?>";

        $(location).attr('href', url+"?r=solicitacao/pdf&data_inicio='"+ inicio.value+"'");
    }
</script>
