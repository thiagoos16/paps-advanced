<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Motorista */

$this->title = "Visualizar Motorista";
$this->params['breadcrumbs'][] = ['label' => 'Motoristas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="motorista-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->cnh], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->cnh], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você tem certeza que deseja apagar esse Motorista?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box box-primary">
        <div class="box-header with-border">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'nome',
                    'cnh',
                    'categoria_cnh',
                    'data_validade_cnh',
                    'tipo',
                    'status',
                    'telefone',
                ],
            ]) ?>
        </div>
    </div>

</div>
