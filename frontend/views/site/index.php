<?php

/* @var $this yii\web\View */

use frontend\models\Usuario;
use yii\helpers\Url;
use yii2fullcalendar\yii2fullcalendar;

$this->title = 'Sistema de Transporte da PCU';
?>
<div class="site-index">

    <div class="jumbotron">
       <!-- <h1>Sejam bem-vindos!</h1>

        <p class="lead">Você está acessando o Sistema de Gerenciamento de Frotas da UFAM.</p>
        -->
        <?php
        if (!Yii::$app->user->isGuest) {
            if (Usuario::findOne(Yii::$app->getUser()->id)->id_departamento == "1") {
                echo yii2fullcalendar::widget(array('events' => $events,));
            }
        }
        ?>
    </div>

</div>
