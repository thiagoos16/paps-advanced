<?php

/* @var $this yii\web\View */

use frontend\models\Usuario;
use yii\helpers\Url;
use yii2fullcalendar\yii2fullcalendar;

$this->title = 'Sistema de Transporte da PCU';
?>
<div class="site-index">

    <div class="jumbotron">
        <div class="box box-primary">
            <div class="box-header with-border">
                <?php
                    if (!Yii::$app->user->isGuest) {
                        if (Usuario::findOne(Yii::$app->getUser()->id)->id_departamento == "1") {
                            echo yii2fullcalendar::widget(array('events' => $events,));
                        }
                    }
                ?>
            </div>
        </div>
    </div>

</div>
