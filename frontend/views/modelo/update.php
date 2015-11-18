<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Modelo */

$this->title = 'Atualizar Modelo: ' . ' ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Modelos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="modelo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'marca_lista' => $marca_lista
    ]) ?>

</div>
