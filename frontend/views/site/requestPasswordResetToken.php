<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>SGF</b>UFAM</a>
    </div><!-- /.login-logo -->

    <div class="login-box-body">
        <div class="site-request-password-reset">
        <h2>Esqueci minha senha</h2>

        <p>Informe seu email. Um link para resetar a sua senha será enviado para ele.</p>

        <div class="row">
            <div class="col-lg-12">

                        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                        <?= $form->field($model, 'email') ?>

                        <div class="form-group">
                            <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary btn-block btn-flat']) ?>
                        </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        </div>
    </div>
</div>
