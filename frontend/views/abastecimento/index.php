<?php

use frontend\models\TipoCombustivel;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AbastecimentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Abastecimentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="abastecimento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p align="right">
        <?= Html::a('Novo Abastecimento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id_posto',
                    'id_veiculo',

                    [
                        'attribute' => 'id_combustivel',
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'id_combustivel',
                            ArrayHelper::map(TipoCombustivel::find()->asArray()->all(), 'id', 'nome'),
                            ['class'=>'form-control','prompt'=>'Filtrar'  ]),
                    ],

                    'qty_litro',
                    // 'data_lancamento',
                    // 'id_motorista',
                    // 'data_abastecimento',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            </div>
        </div>
</div>
