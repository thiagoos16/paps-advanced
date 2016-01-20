<?php

/* @var $this yii\web\View */

use frontend\models\Usuario;
use yii\helpers\Url;
use yii2fullcalendar\yii2fullcalendar;

$this->title = 'Sistema de Transporte da PCU';
?>
<div class="site-index">
    <?php
        if (!Yii::$app->user->isGuest) {
            if (Usuario::findOne(Yii::$app->getUser()->id)->id_departamento == "1") {
                echo "<div class='jumbotron'>";
                echo "<div class='box box-primary'>";
                echo "<div class='box-header with-border'>";
                echo yii2fullcalendar::widget(array('events' => $events,));
                echo "</div>";
                echo "</div>";
            }
        }

    ?>
</div>

</div>
