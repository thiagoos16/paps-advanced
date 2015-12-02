<?php

use dosamigos\datepicker\DatePicker;
use frontend\models\Motorista;
use frontend\models\TipoCombustivel;
use frontend\models\PostoAbastecimento;
use frontend\models\Veiculo;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Abastecimento */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="abastecimento-form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'id_posto')->dropDownList(ArrayHelper::map(PostoAbastecimento::find()->all(), 'id', 'nome'), ['prompt'=>'Selecione uma opção']) ?>

            <?= $form->field($model, 'id_combustivel')->dropDownList(ArrayHelper::map(TipoCombustivel::find()->all(), 'id', 'nome'),
                ['prompt'=>'Selecione uma opção',
                'onchange' =>'
                var valor_abastecimento = document.getElementById("abastecimento-valor_abastecido").value;

                $.get("index.php?r=abastecimento/calculo&id='.'" + $(this).val()+"&valor_abastecido="+valor_abastecimento, function(data){
                    //console.log("res: "+data);
                    document.getElementById("abastecimento-qty_litro").value = data;

                });',

                ]) ?>

            <?= $form->field($model, 'valor_abastecido')->textInput([
                'onkeyup' =>'
                    var id_combustivel = document.getElementById("abastecimento-id_combustivel").value;

                    $.get("index.php?r=abastecimento/calculo&valor_abastecido='.'" + $(this).val()+"&id="+id_combustivel, function(data){
                        //console.log("res: "+data);
                        document.getElementById("abastecimento-qty_litro").value = data;

                    });',
            ]) ?>

            <?= $form->field($model, 'qty_litro')->textInput(['readonly' => 'true']) ?>

            <?= $form->field($model, 'id_veiculo')->dropDownList(ArrayHelper::map(Veiculo::find()->all(), 'renavam', 'placa_atual'), ['prompt'=>'Selecione uma opção']) ?>

            <?= $form->field($model, 'km')->textInput() ?>

            <?= $form->field($model, 'id_motorista')->dropDownList(ArrayHelper::map(Motorista::find()->all(), 'cnh', 'nome'), ['prompt'=>'Selecione uma opção']) ?>

            <?= $form->field($model, 'data_abastecimento')->widget(
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
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Novo' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>
