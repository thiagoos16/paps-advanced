<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\RespostaSolicitacao */

$this->title = $model->id_solicitacao;
$this->params['breadcrumbs'][] = ['label' => 'Responder Solicitações', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resposta-solicitacao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_solicitacao], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_solicitacao], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_solicitacao',
            'hora_chegada',
            'id_motorista',
            'id_veiculo',
            'Seguro',
        ],
    ]) ?>

</div>
