<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Abastecimento */

$this->title = 'Create Abastecimento';
$this->params['breadcrumbs'][] = ['label' => 'Abastecimentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="abastecimento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
