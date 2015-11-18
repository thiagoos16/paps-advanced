<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ManutencaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manutencao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'data_entrada') ?>

    <?= $form->field($model, 'servico') ?>

    <?= $form->field($model, 'custo') ?>

    <?= $form->field($model, 'data_saida') ?>

    <?php // echo $form->field($model, 'tipo') ?>

    <?php // echo $form->field($model, 'data_lancamento') ?>

    <?php // echo $form->field($model, 'id_veiculo') ?>

    <?php // echo $form->field($model, 'km') ?>

    <?php // echo $form->field($model, 'id_motorista') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
