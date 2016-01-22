<?php

use frontend\models\Abastecimento;
use frontend\models\CombustivelMes;
use frontend\models\PostoAbastecimento;
use frontend\models\TipoCombustivel;
use frontend\models\Veiculo;
use yii\helpers\ArrayHelper;
use yii\base\ErrorException;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Abastecimento */
/* @var $aux frontend\models\CombustivelMes */

$this->title = 'Exibir Abastecimento';
$this->params['breadcrumbs'][] = ['label' => 'Abastecimentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="abastecimento-view">

    <?php
    try{
        $aux = CombustivelMes::findOne(
            [
            'ano'=>date('Y', strtotime($model->data_abastecimento)),
            'mes' =>date('m', strtotime($model->data_abastecimento))
            ])->valor;
    }catch (Exception $e){
        $aux = 0;
    }

    $abastecimento = Abastecimento::findOne($model->id);
    $model->valor_abastecido = $aux * $model->qty_litro;
    Abastecimento::updateAll(['id'=>$model->id], ['valor_abastecido'=> $model->qty_litro]);

    if(Yii::$app->session->hasFlash('success')) {
        echo '<br>';
        echo "<div class='alert alert-success' data-dismiss='alert'>";
        //echo "<div class='alert alert-success close' data-dismiss='alert' aria-hidden='true'>";
        echo Yii::$app->session->getFlash('success');
        echo "</div>";
    }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p align="right">
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza de que deseja excluir este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php
        $data_lancamento = $model->data_lancamento;
        $data=date('d/m/Y h:i:s',strtotime($data_lancamento));
    ?>

    <div class="box box-primary">
        <div class="box-header with-border">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [

                    [
                        'attribute'=> 'id_posto',
                        'value'=>PostoAbastecimento::findOne($model->id_posto)->nome
                    ],

                    [
                        'attribute' => 'id_combustivel',
                        'value' => TipoCombustivel::findOne($model->id_combustivel)->nome
                    ],

                    [
                        'attribute'=>'valor_abastecido',
                        'value' => 'R$ '.str_replace('.', ',',sprintf("%.2f", $model->valor_abastecido))
                    ],

                    [
                        'attribute'=> 'qty_litro',
                        'value' => $model->qty_litro." L"
                    ],

                    [
                        'attribute' =>'id_veiculo',
                        'value' => Veiculo::findOne($model->id_veiculo)->placa_atual
                    ],
                    [
                        'attribute'=> 'km',
                        'value' => $model->km." Km"
                    ],
                    'data_lancamento',
                    /*[
                        'attribute' => 'data_lancamento',
                        'format' => 'raw',
                        'value' => $data,
                    ],*/

                    'id_motorista',
                    'data_abastecimento',
                ],
            ]) ?>
        </div>
    </div>
</div>
