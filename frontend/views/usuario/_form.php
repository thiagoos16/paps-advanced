<?php

use frontend\models\Departamento;
use yii\helpers\ArrayHelper;
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

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'observacao')->textarea(['rows'=>'5'])?>

            <?= $form->field($model, 'id_departamento')->dropDownList(ArrayHelper::map(Departamento::find()->all(),'id','nome'),['prompt'=>'Selecione uma opção']) ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Novo' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
