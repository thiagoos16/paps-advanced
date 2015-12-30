<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Motorista */

$this->title = "Exibir Motorista";
$this->params['breadcrumbs'][] = ['label' => 'Motoristas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="motorista-view">

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
        <?= Html::a('Editar', ['update', 'id' => $model->cnh], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->cnh], [
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
