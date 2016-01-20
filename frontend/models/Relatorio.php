<?php

namespace frontend\models;

use yii\base\Model;

class Relatorio extends Model{

    public $ano;

    public function rules(){
        return [
            [['ano'],'required'],
        ];
    }

    public function getAno(){
        return array_combine(range(date('Y')+1,1900,-1),range(date('Y')+1,1900,-1));
    }

}