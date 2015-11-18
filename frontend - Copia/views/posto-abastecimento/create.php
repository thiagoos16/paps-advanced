<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PostoAbastecimento */

$this->title = 'Novo Posto de Abastecimento';
$this->params['breadcrumbs'][] = ['label' => 'Postos de Abastecimentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posto-abastecimento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
