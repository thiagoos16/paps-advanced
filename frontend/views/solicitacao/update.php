<?php

use frontend\models\Usuario;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Solicitacao */

$this->title = 'Editar Solicitação';
$this->params['breadcrumbs'][] = ['label' => 'Solicitações', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>

<div class="solicitacao-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', ['model' => $model,])?>
</div>