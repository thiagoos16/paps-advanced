<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuários';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p align="right">
        <?= Html::a('Novo Usuário', ['/site/signup'], ['class' => 'btn btn-success']); ?>

    </p>
    <div class="box box-primary">
        <div class="box-header with-border">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'nome',
                    'username',
                    'email:email',
                    // 'status',
                    // 'created_at',
                    // 'updated_at',

                    // 'observacao',
                    // 'confirma_senha',
                    // 'id_departamento',

                    ['class' => 'yii\grid\ActionColumn'],
                ],

            ]); ?>
            </div>
        </div>

</div>
