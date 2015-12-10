<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Manutencao */

$this->title = 'Visualizar Manutenção';
$this->params['breadcrumbs'][] = ['label' => 'Manutenções', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manutencao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p align="right">
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza que deseja deletar esse item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box box-primary">
        <div class="box-header with-border">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'id',
                    'data_entrada',
                    'servico',
                    'custo',
                    'data_saida',
                    'tipo',
                    'data_lancamento',
                    'id_veiculo',
                    'km',
                    'id_motorista',
                ],
            ]) ?>
        </div>
    </div>
</div>
