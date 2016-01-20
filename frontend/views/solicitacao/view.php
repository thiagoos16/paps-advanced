<?php

use frontend\models\Usuario;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Solicitacao */

$this->title = "Exibir Solicitação";
$this->params['breadcrumbs'][] = ['label' => 'Solicitações', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitacao-view">

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
        <?php
        $departamento = Usuario::findOne(Yii::$app->getUser()->id)->id_departamento;
        $status = $model->status;
        if($departamento != 1 && $status == 'Em análise') {
            //echo Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            echo  Html::a('Deletar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Tem certeza de que deseja excluir este item?',
                    'method' => 'post',
                ],
            ]);
        }
        ?>
    </p>

    <div class="box box-primary">
        <div class="box-header with-border">
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
                    [
                    'attribute' => 'id_usuario',
                        'value' => Usuario::findOne($model->id_usuario)->nome
                    ],
                    'capacidade_passageiros',
                    'endeeco_destino',
                    'hora_chegada',
                    'id_motorista',
                    'id_veiculo',
                    'seguro',
                ],
            ]) ?>

    <?php

    $departamento = Usuario::findOne(Yii::$app->getUser()->id)->id_departamento;
    $status = $model->status;
    if($departamento == 1 && $status == 'Em análise') {
        echo "<div align='right'>";
        echo Html::a('Aceitar Solicitação', ['resposta', 'id' => $model->id], ['class' => 'btn btn-success']);
        echo " ";
        echo Html::a('Rejeitar Solicitação', ['rejeitar', 'id' => $model->id], ['class' => 'btn btn-danger']);
        echo "</div>";
    }
    ?>
        </div>
    </div>
</div>
