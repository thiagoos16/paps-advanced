<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>STP</b>CU</a>
    </div><!-- /.login-logo -->

    <div class="login-box-body">
        <p class="login-box-msg">Efetuar Login no Sistema</p>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <div class="form-group has-feedback">
                <?= $form->field($model, 'username') ?>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <?= $form->field($model, 'password')->passwordInput() ?>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <?= $form->field($model, 'rememberMe')->checkbox() ?>
                        </label>
                    </div>
                </div><!-- /.col -->
                <div class="col-xs-4">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div><!-- /.col -->
            </div>

        <?php ActiveForm::end(); ?>

        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div><!-- /.social-auth-links -->

        <?= Html::a('Esqueci minha senha', ['site/request-password-reset']) ?> <br>
        <?= Html::a('Registrar novo membro', ['site/signup']) ?> <br>


    </div>

</div>
