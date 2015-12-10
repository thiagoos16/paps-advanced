<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\VeiculoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Veículos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="veiculo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p align="right">
        <?= Html::a('Novo Veículo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'renavam',
                    'cidade',
                    'chassi',
                    'num_patrimonio',
                    'lotacao',
                    // 'status',
                    // 'observacao',
                    // 'adquirido_de',
                    // 'uf_atual',
                    // 'uf_anterior',
                    // 'placa_atual',
                    // 'placa_anterior',
                    // 'potencia',
                    // 'id_modelo',
                    // 'id_cor',
                    // 'id_tipo_combustivel',
                    // 'ano_fabricacao',
                    // 'ano_modelo',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
