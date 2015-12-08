<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Solicitacao */

$this->title = 'Atualizar Solicitação de n°: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Solicitações', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="solicitacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formResposta', [
        'model' => $model,
    ]) ?>

</div>
