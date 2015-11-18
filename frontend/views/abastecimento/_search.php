<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AbastecimentoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="abastecimento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'preco_litro') ?>

    <?= $form->field($model, 'id_posto') ?>

    <?= $form->field($model, 'id_veiculo') ?>

    <?= $form->field($model, 'km') ?>

    <?php // echo $form->field($model, 'data_lancamento') ?>

    <?php // echo $form->field($model, 'id_motorista') ?>

    <?php // echo $form->field($model, 'data_abastecimento') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
