<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Modelo */

$this->title = 'Editar Modelo';
$this->params['breadcrumbs'][] = ['label' => 'Modelos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="modelo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        $model->id_marca = $model->id_bkp;
        echo $this->render('_form', ['model' => $model, 'marca_lista' => $marca_lista
    ]) ?>

</div>
