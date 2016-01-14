<?php

use frontend\models\Cor;
use frontend\models\Modelo;
use frontend\models\TipoCombustivel;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Veiculo */

$this->title = "Exibir Veículo";
$this->params['breadcrumbs'][] = ['label' => 'Veículos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="veiculo-view">

    <?php
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
        <?= Html::a('Editar', ['update', 'id' => $model->renavam], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->renavam], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza de que deseja excluir este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box box-primary">
        <div class="box-header with-border">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'renavam',
                    'cidade',
                    'chassi',
                    'num_patrimonio',
                    'lotacao',

                    [
                        'attribute' => 'status',
                        'value' => $model->findStatus($model->status)
                    ],
                    'capacidade_passageiros',
                    'observacao',
                    'adquirido_de',
                    'uf_atual',
                    'uf_anterior',
                    'placa_atual',
                    'placa_anterior',
                    'potencia',

                    [
                        'attribute' => 'id_modelo',
                        'value' => Modelo::findOne($model->id_modelo)->nome
                    ],

                    //'id_cor',
                    [
                        'attribute' => 'id_cor',
                        'value' => Cor::findOne($model->id_cor)->nome
                    ],
                    [
                        'attribute' => 'id_tipo_combustivel',
                        'value' => TipoCombustivel::findOne($model->id_tipo_combustivel)->nome
                    ],


                    'ano_fabricacao',
                    'ano_modelo',
                ],
            ]) ?>
            </div>
        </div>
</div>
