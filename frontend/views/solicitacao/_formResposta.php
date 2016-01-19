<?php

use dosamigos\datepicker\DatePicker;
use frontend\models\Motorista;
use frontend\models\Solicitacao;
use frontend\models\Veiculo;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model frontend\models\Solicitacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitacao-form">

    <div class="box box-primary">
        <div class="box-header with-border">

            <?php $form = ActiveForm::begin();
            $data_saida = $model->data_saida;
            $data_saida = date("Y-m-d", strtotime($data_saida));
            ?>


            <?= $form->field($model, 'id_motorista')->dropDownList(ArrayHelper::map(Motorista::find()->all(), 'cnh', 'nome'), $model->getPrompt()) ?>

            <?= $form->field($model, 'id_veiculo')->dropDownList(ArrayHelper::map(Veiculo::findBySql(
                "SELECT veiculo.renavam, veiculo.placa_atual
                FROM veiculo WHERE veiculo.renavam !=(
                SELECT veiculo.renavam
                FROM veiculo INNER JOIN solicitacao
                WHERE veiculo.renavam = solicitacao.id_veiculo
                AND solicitacao.data_saida = '$data_saida')
                ")->all(), 'renavam', 'placa_atual'), $model->getPrompt())
            ?>

            <?= $form->field($model, 'seguro')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'hora_chegada')->textInput(['maxlength' => true])
                ->widget(MaskedInput::className(), [
                    'mask' => '99:99',
                ])
            ?>

            <?= $form->field($model, 'status')->hiddenInput(['maxlength' => true, 'value' => "Aceita", "readonly" => "true"])
            ->label('')
            ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Salvar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
