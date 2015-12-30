<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Departamento;

$this->title = 'Novo Usuário';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="usuario-create">
    <h1><?= Html::encode($this->title) ?></h1>
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="usuario-form">
                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

                        <div class="form-group has-feedback">
                            <?= $form->field($model, 'username') ?>
                        </div>

                        <div class="form-group has-feedback">
                            <?= $form->field($model, 'email') ?>
                        </div>

                        <div class="form-group has-feedback">
                            <?= $form->field($model, 'password')
                                ->hint('Insira no mínimo 6 caracteres.')
                                ->passwordInput() ?>
                        </div>

                    <?= $form->field($model, 'confirma_senha')->passwordInput() ?>

                    <?= $form->field($model, 'id_departamento')->dropDownList(ArrayHelper::map(Departamento::find()->all(),'id','nome'),['prompt'=>'Selecione uma opção']) ?>

                    <?= $form->field($model, 'observacao')->textarea(['rows'=>'5'])?>

                    <div class="col-xs-4">
                        <?= Html::submitButton('Novo', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'signup-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
                </div>
            </div>
        </div>
</div>
