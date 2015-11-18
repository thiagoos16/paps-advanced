<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Veiculo */

$this->title = 'Atualizar Veículo: ' . ' ' . $model->placa_atual;
$this->params['breadcrumbs'][] = ['label' => 'Veículos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->placa_atual, 'url' => ['view', 'id' => $model->renavam]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="veiculo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
