<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\RespostaSolicitacao */

$this->title = 'Update Resposta Solicitacao: ' . ' ' . $model->id_solicitacao;
$this->params['breadcrumbs'][] = ['label' => 'Resposta Solicitacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_solicitacao, 'url' => ['view', 'id' => $model->id_solicitacao]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="resposta-solicitacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
