<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use frontend\models\Modelo;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ModeloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Modelos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modelo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Novo Modelo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'nome',
                    //'ano',
                    [
                        'attribute' => 'id_marca',
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'id_marca',
                            ArrayHelper::map(Modelo::find()->asArray()->all(), 'id', 'nome'),
                            ['class'=>'form-control','prompt'=>'Filtrar'  ]),
                    ],
                    //'id_marca',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>

</div>