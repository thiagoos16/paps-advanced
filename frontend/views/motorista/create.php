<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Motorista */

$this->title = 'Novo Motorista';
$this->params['breadcrumbs'][] = ['label' => 'Motoristas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="motorista-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

