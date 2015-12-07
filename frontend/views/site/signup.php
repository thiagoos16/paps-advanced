<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="usuario-form">
            <p class="login-box-msg">Registrar um novo usuário</p>
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

                <div class="form-group has-feedback">
                    <?= $form->field($model, 'username') ?>
                </div>

                <div class="form-group has-feedback">
                    <?= $form->field($model, 'email') ?>
                </div>

                <div class="form-group has-feedback">
                    <?= $form->field($model, 'password')->passwordInput() ?>
                </div>

            <?= $form->field($model, 'confirma_senha')->passwordInput() ?>

            <?= $form->field($model, 'id_departamento')->dropDownList($departamento_lista, $model->getPrompt()) ?>

            <?= $form->field($model, 'observacao')->textarea(['rows'=>'5'])?>

            <div class="col-xs-4">
                <?= Html::submitButton('Novo', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
        </div>
    </div>
</div>
