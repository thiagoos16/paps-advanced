<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SolicitacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Solicitações';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p align="right">
        <?= Html::a('Nova Solicitação', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'destino',
                    'data_saida',
                    //'hora_saida',
                    //'data_lancamento',
                    // 'observacao',
                    'status',
                    // 'id_usuario',
                    // 'capacidade_passageiros',
                    // 'endeeco_destino',
                    // 'hora_chegada',
                    // 'id_motorista',
                    // 'id_veiculo',
                    // 'seguro',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
