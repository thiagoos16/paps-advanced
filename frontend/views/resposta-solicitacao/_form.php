<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\RespostaSolicitacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resposta-solicitacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_solicitacao')->textInput() ?>

    <?= $form->field($model, 'hora_chegada')->textInput() ?>

    <?= $form->field($model, 'id_motorista')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_veiculo')->textInput() ?>

    <?= $form->field($model, 'Seguro')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
