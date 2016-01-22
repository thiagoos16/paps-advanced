<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\CombustivelMes */

$this->title = 'Novo Combustível Mês';
$this->params['breadcrumbs'][] = ['label' => 'Combustível', 'url' => ['tipo-combustivel/index']];
$this->params['breadcrumbs'][] = ['label' => 'Combustível Mês', 'url' => ['index', 'id'=>$model->id_combustivel]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="combustivel-mes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
