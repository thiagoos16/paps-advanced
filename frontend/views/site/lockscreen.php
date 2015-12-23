<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use frontend\assets\AppAsset;
use frontend\models\Usuario;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$asset = AppAsset::register($this);
$baseUrl = $asset->baseUrl;

$this->title = 'Bloqueio de Tela';
$this->params['breadcrumbs'][] = $this->title;
?>

<script>
    window.history.forward(1);

</Script>
<script type = "text/javascript" >
</script>

<div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
        <b>SGF</b>UFAM
    </div>
    <!-- User name -->
    <div class="lockscreen-name">
        <h3><?= Usuario::findOne(Yii::$app->getUser()->id)->nome ?></h3><br>
    </div>

    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
            <img src="<?=$baseUrl."/dist/img/ufam.png"?>" alt="User Image">
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->

        <?php $form = ActiveForm::begin(
            ['options' => [
                'class'=> 'lockscreen-credentials',
                ]
            ]);
        ?>
            <div class="input-group-mod">
                <?= $form->field($model, 'password')->passwordInput(['class'=>'form-control', 'placeholder' => 'Informe a senha'])->label(false)  ?>
                <div class="input-group-btn-mod">
                    <button type="submit" class="btn"> <i class="fa fa-arrow-right text-muted"></i></button>
                </div>
            </div>
        <?php ActiveForm::end(); ?><!-- /.lockscreen credentials -->


    </div><!-- /.lockscreen-item -->

    <div id="teste">
        <div class="help-block text-center">
            Informe a sua senha para voltar a sua sessão.
        </div>
        <div class="text-center">
            <a href="index.php?r=site/logout">Ou entre como um usuário diferente</a>
        </div>
        <div class="lockscreen-footer text-center">
            Copyright © 2015 Instituto de Computação - Universidade Federal do Amazonas</b><br>
            Todos os direitos reservados
        </div>
    </div>
</div><!-- /.center -->