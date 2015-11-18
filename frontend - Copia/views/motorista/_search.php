<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MotoristaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="motorista-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'cnh') ?>

    <?= $form->field($model, 'categoria_cnh') ?>

    <?= $form->field($model, 'tipo') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'telefone') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
