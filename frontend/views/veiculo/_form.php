<?php

use frontend\models\Modelo;
use frontend\models\TipoCombustivel;
use frontend\models\Cor;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model frontend\models\Veiculo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <div class="veiculo-form">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'renavam')->textInput(['maxlength'=>10,'style'=>'width:200px']) ?>

            <?= $form->field($model, 'cidade')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'chassi')->textInput()
                ->widget(MaskedInput::className(), [
                    'mask' => '*****************',
                ]) ?>

            <?= $form->field($model, 'num_patrimonio')->textInput() ?>

            <?= $form->field($model, 'lotacao')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->dropDownList($model->getStatus(), ['prompt'=>'Selecione uma opção']) ?>

            <?= $form->field($model, 'capacidade_passageiros')->textInput()
                ->hint('Insira um número inteiro.')
            ?>

            <?= $form->field($model, 'observacao')->textarea(['rows'=>'10'])?>

            <?= $form->field($model, 'adquirido_de')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'uf_atual')->textInput(['maxlength' => true])
            ->widget(MaskedInput::className(), [
                'mask' => 'aa',
            ])
            ?>

            <?= $form->field($model, 'uf_anterior')->textInput(['maxlength' => true])
                ->widget(MaskedInput::className(), [
                    'mask' => 'aa',
                ])
            ?>

            <?= $form->field($model, 'placa_atual')->textInput(['maxlength' => true])
                ->widget(MaskedInput::className(), [
                    'mask' => 'aaa-9999',
                ])
            ?>

            <?= $form->field($model, 'placa_anterior')->textInput(['maxlength' => true])
                ->widget(MaskedInput::className(), [
                    'mask' => 'aaa-9999',
                ])
            ?>

            <?= $form->field($model, 'potencia')->textInput() ?>

            <?= $form->field($model, 'id_modelo')->dropDownList(ArrayHelper::map(Modelo::find()->all(), 'id', 'nome'), ['prompt'=>'Selecione uma opção']) ?>

            <?= $form->field($model, 'id_cor')->dropDownList(ArrayHelper::map(Cor::find()->all(), 'id', 'nome'), ['prompt'=>'Selecione uma opção']) ?>

            <?= $form->field($model, 'id_tipo_combustivel')->dropDownList(ArrayHelper::map(TipoCombustivel::find()->all(),'id','nome'), ['prompt'=>'Selecione uma opção'] ) ?>

            <?= $form->field($model, 'ano_fabricacao')->dropDownList(array_combine(range(date('Y')+1,1900,-1),range(date('Y')+1,1900,-1)), ['prompt'=>'Selecione uma opção']) ?>

            <?= $form->field($model, 'ano_modelo')->dropDownList(array_combine(range(date('Y')+1,1900,-1),range(date('Y')+1,1900,-1)), ['prompt'=>'Selecione uma opção']) ?>


            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Salvar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
