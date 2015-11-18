<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Motorista */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="motorista-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cnh') -> widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '99999999999',
    ])
    ?>

    <?= $form->field($model, 'data_validade_cnh')->widget(
        DatePicker::className(), [
            // inline too, not bad
            'inline' => false,
            'language' => 'pt',
            // modify template for custom rendering
            //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);?>

    <?= $form->field($model, 'categoria_cnh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->dropDownList($model->getTipo(), $model->getPrompt()) ?>

    <?= $form->field($model, 'status')->dropDownList($model->getStatus(), $model->getPrompt())?>

    <?= $form->field($model, 'telefone')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '999999999',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Novo' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
