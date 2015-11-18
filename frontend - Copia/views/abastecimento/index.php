<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AbastecimentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Abastecimentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="abastecimento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Abastecimento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'preco_litro',
            'id_posto',
            'id_veiculo',
            'km',
            // 'data_lancamento',
            // 'id_motorista',
            // 'data_abastecimento',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
