<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Veiculo;
use frontend\models\Motorista;

/* @var $this yii\web\View */
/* @var $model frontend\models\Manutencao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manutencao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'servico')->textarea(['rows'=>'3'])?>

    <?= $form->field($model, 'custo')->textInput() ?>

    <?= $form->field($model, 'tipo')->dropDownList($model->getTipo(), $model->getPrompt()) ?>

    <?= $form->field($model, 'data_entrada')->widget(
        DatePicker::className(), [
            // inline too, not bad
            'inline' => false,
            'language' => 'pt',
            //'size' => 'xs',
            // modify template for custom rendering
            //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);?>

    <?= $form->field($model, 'data_saida')->widget(
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

    <?= $form->field($model, 'id_veiculo')->dropDownList(ArrayHelper::map(Veiculo::find()->all(), 'renavam', 'placa_atual'), ['prompt'=>'Selecione a placa do veículo']) ?>

    <?= $form->field($model, 'km')->textInput() ?>

    <?= $form->field($model, 'id_motorista')->dropDownList(ArrayHelper::map(Motorista::find()->all(), 'cnh', 'nome'), ['prompt'=>'Selecione o nome do motorista']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nova' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
