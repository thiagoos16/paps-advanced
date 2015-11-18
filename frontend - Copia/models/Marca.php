<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "marca".
 *
 * @property integer $id
 * @property string $nome
 *
 * @property Modelo[] $modelos
 */
class Marca extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marca';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required', "message"=>"Este campo é obrigatório"],
            [['nome'], 'string', 'max' => 30],
            [['nome'], 'unique', "message"=>"Marca existente no sistema"]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModelos()
    {
        return $this->hasMany(Modelo::className(), ['id_marca' => 'id']);
    }

    public function beforeDelete(){
        if($this->is_required=='no'){
            return true;
        }
        return false;
    }
}
