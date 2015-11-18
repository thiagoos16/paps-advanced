<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VeiculoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="veiculo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'renavam') ?>

    <?= $form->field($model, 'cidade') ?>

    <?= $form->field($model, 'chassi') ?>

    <?= $form->field($model, 'num_patrimonio') ?>

    <?= $form->field($model, 'lotacao') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'observacao') ?>

    <?php // echo $form->field($model, 'adquirido_de') ?>

    <?php // echo $form->field($model, 'uf_atual') ?>

    <?php // echo $form->field($model, 'uf_anterior') ?>

    <?php // echo $form->field($model, 'placa_atual') ?>

    <?php // echo $form->field($model, 'placa_anterior') ?>

    <?php // echo $form->field($model, 'potencia') ?>

    <?php // echo $form->field($model, 'id_modelo') ?>

    <?php // echo $form->field($model, 'id_cor') ?>

    <?php // echo $form->field($model, 'id_tipo_combustivel') ?>

    <?php // echo $form->field($model, 'ano_fabricacao') ?>

    <?php // echo $form->field($model, 'ano_modelo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
