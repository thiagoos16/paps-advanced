<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Olá <?= $user->username ?>,

Um lembrete para a senha da sua conta no SGF-UFAM foi solicitado.

Você pode acessar sua conta agora clicando no link abaixo ou copiando e
colando-o no seu navegador:

<?= $resetLink ?>

Este link pode ser usado uma única vez para entrar no site e vai levar você
para uma página onde você pode trocar a sua senha.
