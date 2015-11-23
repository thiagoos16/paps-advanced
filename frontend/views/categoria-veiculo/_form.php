<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CategoriaVeiculo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-veiculo-form">

    <div class="box box-primary">
        <div class="box-header with-border">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Nova' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
