<?php

use dosamigos\datepicker\DatePicker;
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

            <?= $form->field($model, 'destino')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'endeeco_destino')->textInput(['maxlength' => true]) ?>

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

            <?= $form->field($model, 'hora_saida')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'capacidade_passageiros')->textInput() ?>

            <?= $form->field($model, 'observacao')->textarea(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->textInput(['maxlength' => true, 'value' => "Em análise", "readonly" => "true"]) ?>

            <?= $form->field($model, 'id_usuario')->textInput(['value' => Yii::$app->user->identity->getId(), "readonly" => "true"]) ?>


            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Salvar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
