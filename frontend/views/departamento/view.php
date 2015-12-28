<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Departamento */

$this->title = "Visualizar Departamentos";
$this->params['breadcrumbs'][] = ['label' => 'Departamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departamento-view">

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
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você tem certeza que deseja apagar esse Departamento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box box-primary">
        <div class="box-header with-border">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                   // 'id',
                    'nome',
                ],
            ]) ?>
        </div>
    </div>
</div>
