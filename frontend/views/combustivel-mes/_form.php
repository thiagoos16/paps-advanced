<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CombustivelMes */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="combustivel-mes-form">

            <?php
                $form = ActiveForm::begin();
                $model->mes = $model->mes_bkp;
                $model->mes = $model->mes." - ".$model->ano;
            ?>

            <?php //$form->field($model, 'mes')->dropDownList($model->getMes(), ['prompt'=>'Selecione uma opção']) ?>

            <?= $form->field($model, 'mes')->widget(
                DatePicker::className(), [
                    // inline too, not bad
                    'inline' => false,
                    'language' => 'pt',
                    // modify template for custom rendering
                    //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                    'clientOptions' => [
                        'autoclose' => false,
                        'format' => 'mm - yyyy',
                        'minViewMode' =>1,

                        //'' => 'mm-yyyy',

                    ]
                ]); ?>

            <?= $form->field($model, 'valor')->textInput(['type'=>'number', 'step' => '0.01']) ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Novo' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
