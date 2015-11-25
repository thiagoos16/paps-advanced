<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">
    <div class="box box-primary">
        <div class="box-header with-border">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->textInput() ?>

            <?= $form->field($model, 'created_at')->textInput() ?>

            <?= $form->field($model, 'updated_at')->textInput() ?>

            <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'observacao')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'confirma_senha')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'id_departamento')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Novo' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
