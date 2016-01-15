<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Veiculo */

$this->title = 'Editar Veículo';
$this->params['breadcrumbs'][] = ['label' => 'Veículos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->placa_atual, 'url' => ['view', 'id' => $model->renavam]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="veiculo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        $model->status = $model->id_status_bkp;

        echo $this->render('_form', ['model' => $model,]);
    ?>

</div>
