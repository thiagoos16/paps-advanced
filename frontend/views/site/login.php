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
        <a href="../../index2.html"><b>SGF</b>UFAM</a>
    </div><!-- /.login-logo -->

    <div class="login-box-body">
        <p class="login-box-msg">Entrar no Sistema</p>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <div class="form-group has-feedback">
                <?= $form->field($model, 'username') ?>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
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
                    <?= Html::submitButton('Entrar', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
                </div><!-- /.col -->
            </div>

        <?php ActiveForm::end(); ?>

        <?= Html::a('Esqueci minha senha', ['site/request-password-reset']) ?> <br>

    </div>

</div>
