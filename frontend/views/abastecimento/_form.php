<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Abastecimento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="abastecimento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'preco_litro')->textInput() ?>

    <?= $form->field($model, 'id_posto')->textInput() ?>

    <?= $form->field($model, 'id_veiculo')->textInput() ?>

    <?= $form->field($model, 'km')->textInput() ?>

    <?= $form->field($model, 'data_lancamento')->textInput() ?>

    <?= $form->field($model, 'id_motorista')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_abastecimento')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
