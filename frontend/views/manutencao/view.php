<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Manutencao */

$this->title = 'Exibir Manutenção';
$this->params['breadcrumbs'][] = ['label' => 'Manutenções', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manutencao-view">

    <?= date('Y-m-d', strtotime(""))?>
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
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->id], [
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
                    //'id',
                    [
                        'attribute' => 'data_entrada',
                        'value' => date('d-m-Y', strtotime($model->data_entrada))
                    ],

                    'servico',
                    'custo',

                    [
                        'attribute' => 'data_saida',
                        'value' => date('d-m-Y', strtotime($model->data_saida))
                    ],

                    'tipo',
                    [
                        'attribute' => 'data_lancamento',
                        'value' => date('d-m-Y h:i:s', strtotime($model->data_lancamento))
                    ],

                    'id_veiculo',
                    'km',
                    'id_motorista',
                ],
            ]) ?>
        </div>
    </div>
</div>
