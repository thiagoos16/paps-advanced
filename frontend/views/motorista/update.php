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

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
