<?php

use dosamigos\datepicker\DatePicker;
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
        <button id="exibirfiltro" class="btn btn-warning" onclick="exibirfiltro()">PDF</button>
    </p>

    <div class="box box-primary"  style = "display: none" id="formfiltro">
        <div class="box-header with-border">
            <b>Período da Data de Abastecimento:</b><br><br>
            <b>De:</b>
            <?= DatePicker::widget([
                'id' => 'dataInicio',
                'name' => 'DataEntrada',
                'template' => '{addon}{input}',
                'language' => 'pt',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);?>
            <br>
            <b>Até:</b>
            <?= DatePicker::widget([
                'id' => 'dataFim',
                'name' => 'DataSaida',
                'template' => '{addon}{input}',
                'language' => 'pt',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);?>
            <br>

            <button class="btn btn-warning" onclick="pegardata()">Gerar PDF</button>

        </div>
    </div>

    <div class="box box-primary"  style = "display: none" id="formfiltro">
        <div class="box-header with-border">
            <b>Data Inicial:</b>
            <?= DatePicker::widget([
                'id' => 'DataEntrada',
                'name' => 'DataEntrada',
                'template' => '{addon}{input}',
                'language' => 'pt',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy'
                ]
            ]);?>
            <br>
            <b>Data Final:</b>
            <?= DatePicker::widget([
                'id' => 'DataSaida',
                'name' => 'DataSaida',
                'template' => '{addon}{input}',
                'language' => 'pt',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy'
                ]
            ]);?>
            <br>
            <?= Html::a ('Gerar PDF', ['pdf'], ['class' => 'btn btn-warning', 'target' => '_blank']) ?>

        </div>
    </div>

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
                        'attribute' => 'veiculo',
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

                    //'qty_litro',
                    // 'data_lancamento',
                    // 'id_motorista',
                    //'data_abastecimento',

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
        var fim = document.querySelector('#dataFim');
        var url = "<?= Yii::$app->getHomeUrl()?>";

        $(location).attr('href', url+"?r=abastecimento/pdf&data_inicio='"+ inicio.value+"'&data_fim='"+fim.value+"'");
    }
</script>
