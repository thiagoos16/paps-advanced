<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Abastecimento */

$this->title = 'Editar Abastecimento';
$this->params['breadcrumbs'][] = ['label' => 'Abastecimentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_veiculo, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="abastecimento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
