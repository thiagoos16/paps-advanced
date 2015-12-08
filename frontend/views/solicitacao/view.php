<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Solicitacao */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Solicitações', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitacao-view">

    <h1>Solicitação n° <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você deseja realmente deletar esta solicitação?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'destino',
            'data_saida',
            'hora_saida',
            'data_lancamento',
            'observacao',
            'status',
            'id_usuario',
            'capacidade_passageiros',
            'endeeco_destino',
            'hora_chegada',
            'id_motorista',
            'id_veiculo',
            'seguro',
        ],
    ]) ?>

    <div align="right">
        <?= Html::a('Aceitar Solicitação', ['update', 'id' => $model->id], ['class' => 'btn btn-success btn-lg']) ?>
        <?= Html::a('Rejeitar Solicitação', ['update', 'id' => $model->id], ['class' => 'btn btn-danger btn-lg']) ?>
    </div>

</div>
