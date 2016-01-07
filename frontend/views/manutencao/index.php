<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ManutencaoSearch */
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

$this->title = 'Manutenções';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manutencao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p align="right">
        <?= Html::a('Nova Manutenção', ['create'], ['class' => 'btn btn-success']) ?>
        <button id="exibirfiltro" class="btn btn-warning" onclick="exibirfiltro()">PDF</button>
    </p>

    <div class="box box-primary"  style = "display: none" id="formfiltro">
        <div class="box-header with-border">
            <b>Data de Entrada:</b>
            <?= DatePicker::widget([
                'id' => 'dataEntrada',
                'name' => 'DataEntrada',
                'template' => '{addon}{input}',
                'language' => 'pt',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy'
                ]
            ]);?>
            <br>
            <b>Data de Saída:</b>
            <?= DatePicker::widget([
                'id' => 'dataSaida',
                'name' => 'DataSaida',
                'template' => '{addon}{input}',
                'language' => 'pt',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy'
                ]
            ]);?>
            <br>
           <!-- <?= Html::a ('Gerar PDF', ['pdf'], ['class' => 'btn btn-warning', 'target' => '_blank', 'onclick' => 'pegardata()']) ?> -->
            <button id="teste" class="btn btn-warning" onclick="pegardata()">PDF</button>

        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    [
                        'attribute' => 'data_entrada',
                        //'format' => ['date', 'dd-Y']
                    ],
                    'servico',
                    'custo',
                    [
                       /* 'attribute'=>'data_saida',
                        'format' => ['date', 'dd-MM-yyyy'],
                        'value' => function($model,$index,$widget) {
                            return Yii::$app->formatter->asDate($model->data_saida);
                        },*/
                        'attribute'=>'data_saida',
                        'value' => 'data_saida',
                        //'format' => 'raw',
                        /*'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'data_saida',
                            'clientOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ])*/
                    ],
                    // 'tipo',
                    // 'data_lancamento',
                    // 'id_veiculo',
                    // 'km',
                    // 'id_motorista',

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
        var entrada = document.querySelector('#dataEntrada');
        var saida = document.querySelector('#dataSaida');
        console.log(entrada.value);
        console.log(saida.value);
    }

</script>
