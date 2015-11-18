<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostoAbastecimentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Postos de Abastecimentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posto-abastecimento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Novo Posto de Abastecimento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nome',
            'endereco',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
