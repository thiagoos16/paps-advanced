<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TipoCombustivel */

$this->title = 'Editar Tipo de Combustível';
$this->params['breadcrumbs'][] = ['label' => 'Tipo de Combustível', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="tipo-combustivel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
