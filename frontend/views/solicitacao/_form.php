<?php

use dosamigos\datepicker\DatePicker;
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

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->errorSummary($model) ?>

            <?= $form->field($model, 'destino')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'endeeco_destino')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'data_saida')->widget(
                DatePicker::className(), [
                    // inline too, not bad
                    'inline' => false,
                    'language' => 'pt',

                    //'dateFormat' => 'dd-mm-yyyy',
                    // modify template for custom rendering
                    //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                    'clientOptions' => [
                        //'convertFormat'=> true,
                        //'value' => 'dd-mm-yyyy',
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy'

                    ]
                ]);?>

            <?= $form->field($model, 'hora_saida')->textInput(['maxlength' => true])
                ->widget(MaskedInput::className(), [
                    'mask' => '99:99',
                ])
            ?>

            <?= $form->field($model, 'capacidade_passageiros')->textInput() ?>

            <?= $form->field($model, 'observacao')->textarea(['maxlength' => true]) ?>

            <?php
            if($model->isNewRecord) {
                $status="Em análise";
            }
            else {
                $status=$model->status;
            }
            ?>

            <?=
            $model->isNewRecord?
                $form->field($model, 'status')->hiddenInput(['value' => $status])
                    ->label('') :
                $form->field($model, 'status')->textInput(['maxlength' => true, 'value' => $status, "readonly" => "true"])
            ?>




            <div class="form-group">
                <!-- nova solicitação: botão verde
                edição de solicitação: botão azul-->
                <?php
                //Yii::$app->user->setFlash('success', 'Salvo com sucesso.');
                ?>
                <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Salvar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
