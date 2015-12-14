<?php

use dosamigos\datepicker\DatePicker;
use frontend\models\Motorista;
use frontend\models\Solicitacao;
use frontend\models\Veiculo;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Solicitacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitacao-form">

    <div class="box box-primary">
        <div class="box-header with-border">

            <?php $form = ActiveForm::begin(); ?>


            <?= $form->field($model, 'id_motorista')->dropDownList(ArrayHelper::map(Motorista::find()->all(), 'cnh', 'nome'), $model->getPrompt()) ?>

            <?= $form->field($model, 'id_veiculo')->dropDownList(ArrayHelper::map(Veiculo::find()->all(), 'renavam', 'placa_atual'), $model->getPrompt()) ?>

            <?= $form->field($model, 'seguro')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'hora_chegada')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->textInput(['maxlength' => true, 'value' => "Aceita", "readonly" => "true"]) ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Salvar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
