<?php
/* @var $model frontend\models\Relatorio */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Escolher o Ano';
$this->params['breadcrumbs'][] = ['label' => 'Relatório Anual', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?php $form =ActiveForm::begin(); ?>

<div class="box box-primary">
    <div class="box-header with-border">
        <?= $form->field($model,'ano')->dropDownList(
                $model->getAno(),
                ['prompt' => '-Selecione do Ano'])
        ?>

        <div class="form-group">
            <?=Html::submitButton('Gerar Relatório', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end() ?>
