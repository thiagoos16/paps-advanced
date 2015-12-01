<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Solicitacao */

$this->title = 'Create Solicitacao';
$this->params['breadcrumbs'][] = ['label' => 'Solicitacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
