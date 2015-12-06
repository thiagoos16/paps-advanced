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

    <?= $form->field($model, 'capacidade_passageiros')->textInput() ?>

    <?= $form->field($model, 'observacao')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['value' => 1, 'readonly' => true]) ?>

    <?= $form->field($model, 'id_usuario')->textInput(['value' => Yii::$app->user->identity->getId(), 'readonly' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Salvar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
