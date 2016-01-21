<?php

use frontend\models\TipoCombustivel;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TipoCombustivel */

$this->title = 'Atualizar Tipo de Combustível: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tipo de Combustívels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => TipoCombustivel::findOne($model->id)->nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="tipo-combustivel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
