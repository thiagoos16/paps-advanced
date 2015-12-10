<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PostoAbastecimento */

$this->title = 'Editar Posto de Abastecimento';
$this->params['breadcrumbs'][] = ['label' => 'Postos de Abastecimentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="posto-abastecimento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
