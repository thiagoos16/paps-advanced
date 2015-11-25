<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="register-box">

    <div class="register-logo">
        <a href="../../index2.html"><b>SGF</b>UFAM</a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Registrar um novo usuário</p>
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

        <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

            <div class="form-group has-feedback">
                <?= $form->field($model, 'username') ?>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <?= $form->field($model, 'email') ?>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <?= $form->field($model, 'password')->passwordInput() ?>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
        <div class="col-xs-8">
            <!--Faz o botão de Registrar ficar no lugar certo-->
        </div>

        <?= $form->field($model, 'confirma_senha')->passwordInput() ?>

        <?= $form->field($model, 'id_departamento')->dropDownList($departamento_lista, $model->getPrompt()) ?>

        <?= $form->field($model, 'observacao')->textarea(['rows'=>'5'])?>

        <div class="col-xs-4">
            <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <?= Html::a('Voltar à tela de Login', ['site/login']) ?> <br>
    </div>
</div>
