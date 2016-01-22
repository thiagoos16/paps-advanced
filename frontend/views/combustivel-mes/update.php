<?php

use frontend\models\TipoCombustivel;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CombustivelMes */

$this->title = 'Atualizar Combustível';
$this->params['breadcrumbs'][] = ['label' => 'Combustível', 'url' => ['tipo-combustivel/index']];
$this->params['breadcrumbs'][] = ['label' => 'Combustível Mês', 'url' => ['index', 'id'=>$model->id_combustivel]];
$this->params['breadcrumbs'][] = ['label' => TipoCombustivel::findOne($model->id_combustivel)->nome, 'url' => ['view', 'id_combustivel' => $model->id_combustivel, 'mes' => $model->mes, 'ano' => $model->ano]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="combustivel-mes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
