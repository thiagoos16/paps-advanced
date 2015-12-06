<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Solicitacao */

$this->title = 'Nova Solicitação';
$this->params['breadcrumbs'][] = ['label' => 'Solicitações', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
