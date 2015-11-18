<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PostoAbastecimento */

$this->title = 'Atualizar Posto de Abastecimento: ' . ' ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Postos de Abastecimentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="posto-abastecimento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
