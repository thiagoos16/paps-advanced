<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\SolicitacaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitacao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'destino') ?>

    <?= $form->field($model, 'hora_saida') ?>

    <?= $form->field($model, 'data_hora') ?>

    <?= $form->field($model, 'observacao') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'id_usuario') ?>

    <?php // echo $form->field($model, 'capacidade_passageiros') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
