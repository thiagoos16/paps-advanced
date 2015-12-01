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

    <p>
        <?= Html::a('Nova Solicitação', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'destino',
            'hora_saida',
            'data_hora',
            'observacao',
            // 'status',
            // 'id_usuario',
            // 'capacidade_passageiros',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
