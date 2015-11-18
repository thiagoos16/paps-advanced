<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Manutencao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manutencao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data_entrada')->widget(
        DatePicker::className(), [
            // inline too, not bad
            'inline' => false,
            'language' => 'pt',
            // modify template for custom rendering
            //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'dd-mm-yyyy'
            ]
        ]);?>

    <?= $form->field($model, 'servico')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'custo')->textInput() ?>

    <?= $form->field($model, 'data_saida')->widget(
        DatePicker::className(), [
            // inline too, not bad
            'inline' => false,
            'language' => 'pt',
            // modify template for custom rendering
            //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'dd-mm-yyyy'
            ]
        ]);?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_lancamento')->widget(
        DatePicker::className(), [
            // inline too, not bad
            'inline' => false,
            'language' => 'pt',
            // modify template for custom rendering
            //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'dd-mm-yyyy'
            ]
        ]);?>

    <?= $form->field($model, 'id_veiculo')->textInput() ?>

    <?= $form->field($model, 'km')->textInput() ?>

    <?= $form->field($model, 'id_motorista')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nova' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
