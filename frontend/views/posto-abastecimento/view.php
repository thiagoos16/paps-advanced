<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\PostoAbastecimento */

$this->title =  "Visualizar Posto de Abastecimento";
$this->params['breadcrumbs'][] = ['label' => 'Posto de Abastecimento', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posto-abastecimento-view">

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
                    'nome',
                    'endereco',
                ],
            ]) ?>
        </div>
    </div>
</div>
