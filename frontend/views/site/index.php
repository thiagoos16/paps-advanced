<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Sistema de Transporte da PCU';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Sejam bem-vindos!</h1>

        <p class="lead">Você está acessando o Sistema de Gerenciamento de Frotas da UFAM.</p>

    </div>

    <?= yii2fullcalendar\yii2fullcalendar::widget([
        'options' => [
            'language' => 'de',
            //... more options to be defined here!
        ],
        'ajaxEvents' => Url::to(['/timetrack/default/jsoncalendar'])
    ]);
    ?>
</div>
