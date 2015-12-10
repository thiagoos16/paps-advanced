<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Manutencao */

$this->title = 'Editar Manutenção';
$this->params['breadcrumbs'][] = ['label' => 'Manutenções', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_veiculo, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="manutencao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
