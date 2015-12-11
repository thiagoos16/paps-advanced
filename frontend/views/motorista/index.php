<?php

use frontend\models\Motorista;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MotoristaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Motoristas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="motorista-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p align="right">
        <?= Html::a('Novo Motorista', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a ('Gerar PDF', ['pdf'], ['class' => 'btn btn-warning', 'target' => '_blank']) ?>
    </p>

    <div class="box box-primary">
        <div class="box-header with-border">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'nome',
                'cnh',
                'categoria_cnh',
                /*[
                    'attribute' => 'categoria_cnh',
                    'filter' => Html::activeDropDownList($searchModel, 'categoria_cnh', Motorista::getCategoria(),['class'=>'form-control','prompt'=>'Filtrar'  ]),
                ],*/
                //'tipo',
                //'status',
                [
                    'attribute' => 'tipo',
                    'filter' => Html::activeDropDownList($searchModel, 'tipo', Motorista::getTipo(),['class'=>'form-control','prompt'=>'Filtrar']),
                ],
                // 'telefone',

                ['class' => 'yii\grid\ActionColumn'],
            ],

        ]); ?>
        </div>
    </div>

</div>
