<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Motorista */

$this->title = 'Editar Motorista';
$this->params['breadcrumbs'][] = ['label' => 'Motoristas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->cnh]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="motorista-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        $model->tipo = $model->id_tipo_bkp;
        $model->status = $model->id_status_bkp;
        echo $this->render('_form', ['model' => $model,]) ?>

</div>
