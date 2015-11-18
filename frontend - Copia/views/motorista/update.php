<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Motorista */

$this->title = 'Atualizar Motorista: ' . ' ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Motoristas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cnh, 'url' => ['view', 'id' => $model->cnh]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="motorista-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
