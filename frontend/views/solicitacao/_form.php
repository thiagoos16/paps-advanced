<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Solicitacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'destino')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hora_saida')->textInput() ?>

    <?= $form->field($model, 'data_hora')->textInput() ?>

    <?= $form->field($model, 'observacao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_usuario')->textInput() ?>

    <?= $form->field($model, 'capacidade_passageiros')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
