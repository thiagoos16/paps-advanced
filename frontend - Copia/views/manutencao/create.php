<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Manutencao */

$this->title = 'Nova Manutenção';
$this->params['breadcrumbs'][] = ['label' => 'Manutenções', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manutencao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
