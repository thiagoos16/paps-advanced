<?php

use frontend\models\TipoCombustivel;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\CombustivelMes */

$this->title = 'Visualizar preço para o mês de '.$model->mes;
$this->params['breadcrumbs'][] = ['label' => 'Combustível', 'url' => ['tipo-combustivel/index']];
$this->params['breadcrumbs'][] = ['label' => 'Combustível Mes', 'url' => ['index', 'id'=>$model->id_combustivel]];
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
        $sql = "
                UPDATE abastecimento
                  SET abastecimento.valor_abastecido = $model->valor * abastecimento.qty_litro
                  WHERE
                    YEAR(abastecimento.data_abastecimento) = $model->ano AND
                    MONTH(abastecimento.data_abastecimento)= $model->mes_bkp AND
                abastecimento.id_combustivel = $model->id_combustivel";

        $connection = \Yii::$app->db->createCommand($sql)->execute();
        //echo $sql;


    ?>

        <div class="combustivel-mes-view">
            <div class="box box-primary">
                <div class="box-header with-border">


            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute'=>'id_combustivel',
                        'value' => TipoCombustivel::findOne($model->id_combustivel)->nome
                    ],
                    'mes',
                    'ano',
                    [
                        'attribute' => 'valor',
                        'value' => 'R$ '.str_replace('.', ',',sprintf("%.2f", $model->valor))
                    ],

                ],
            ]) ?>

        </div>
    </div>
</div>
