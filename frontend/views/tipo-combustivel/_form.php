<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TipoCombustivel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-combustivel-form">

    <div class="box box-primary">
        <div class="box-header with-border">

            <?php
                $form = ActiveForm::begin();
                $model->data = date('d-m-Y', strtotime($model->data));
            ?>

            <?= $form->errorSummary($model) ?>

            <?= $form->field($model, 'nome')->textInput()->hint('Insira o nome do combustivel acompanhado do nome do mês') ?>

            <?= $form->field($model, 'data')->widget(
                DatePicker::className(), [
                    // inline too, not bad
                    'inline' => false,
                    'language' => 'pt',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy'
                    ]
                ]);?>

            <?= $form->field($model, 'preco_litro')->textInput()
            ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Salvar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
