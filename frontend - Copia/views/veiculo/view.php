<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Veiculo */

$this->title = $model->placa_atual;
$this->params['breadcrumbs'][] = ['label' => 'Veículos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="veiculo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->renavam], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->renavam], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você tem certesa que Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'renavam',
            'cidade',
            'chassi',
            'num_patrimonio',
            'lotacao',
            'status',
            'observacao',
            'adquirido_de',
            'uf_atual',
            'uf_anterior',
            'placa_atual',
            'placa_anterior',
            'potencia',
            'id_modelo',
            'id_cor',
            'id_tipo_combustivel',
            'ano_fabricacao',
            'ano_modelo',
        ],
    ]) ?>

</div>
