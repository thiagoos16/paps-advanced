<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\RespostaSolicitacao */

$this->title = 'Responder Solicitação';
$this->params['breadcrumbs'][] = ['label' => 'Responder Solicitações', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resposta-solicitacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
