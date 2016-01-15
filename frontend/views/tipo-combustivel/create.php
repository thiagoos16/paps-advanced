<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\TipoCombustivel */

$this->title = 'Novo Tipo De Combustível';
$this->params['breadcrumbs'][] = ['label' => 'Tipo De Combustível', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-combustivel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
