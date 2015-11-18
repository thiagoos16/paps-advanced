<?php

use app\models\Modelo;
use app\models\TipoCombustivel;
use app\models\Cor;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Veiculo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="veiculo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'renavam')->textInput() ?>

    <?= $form->field($model, 'cidade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chassi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_patrimonio')->textInput() ?>

    <?= $form->field($model, 'lotacao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->getStatus(), ['prompt'=>'Selecione uma opção']) ?>

    <?= $form->field($model, 'observacao')->textarea(['rows'=>'10'])?>

    <?= $form->field($model, 'adquirido_de')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uf_atual')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uf_anterior')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'placa_atual')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'placa_anterior')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'potencia')->textInput() ?>

    <?= $form->field($model, 'id_modelo')->dropDownList(ArrayHelper::map(Modelo::find()->all(), 'id', 'nome'), ['prompt'=>'Selecione uma opção']) ?>

    <?= $form->field($model, 'id_cor')->dropDownList(ArrayHelper::map(Cor::find()->all(), 'id', 'nome'), ['prompt'=>'Selecione uma opção']) ?>

    <?= $form->field($model, 'id_tipo_combustivel')->dropDownList(ArrayHelper::map(TipoCombustivel::find()->all(),'id','nome'), ['prompt'=>'Selecione uma opção'] ) ?>

    <?= $form->field($model, 'ano_fabricacao')->dropDownList(array_combine(range(date('Y')+1,1900,-1),range(date('Y')+1,1900,-1)), ['prompt'=>'Selecione uma opção']) ?>

    <?= $form->field($model, 'ano_modelo')->dropDownList(array_combine(range(date('Y')+1,1900,-1),range(date('Y')+1,1900,-1)), ['prompt'=>'Selecione uma opção']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Novo' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
