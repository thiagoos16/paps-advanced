<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tipo_combustivel".
 *
 * @property integer $id
 * @property integer $nome
 * @property integer $preco_litro
 *
 * @property Veiculo[] $veiculos
 */
class TipoCombustivel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_combustivel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['preco_litro'], 'number'],
            [['nome'], 'unique', "message"=>"Combustível existente no sistema"],
            [['nome', 'preco_litro'], 'required', "message"=>"Este campo é obrigatório"],
            [['nome'], 'string', 'max' => 50]
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
            'preco_litro' => 'Preço Por Litro',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVeiculos()
    {
        return $this->hasMany(Veiculo::className(), ['id_tipo_combustivel' => 'id']);
    }

    public function beforeDelete(){

        $connection = \Yii::$app->db;
        $m = $connection->createCommand("SELECT * FROM veiculo WHERE id_tipo_combustivel='$this->id'");
        $veiculos=$m->queryAll();
        $count=0;

        foreach ($veiculos as $reg):
            $count++;
        endforeach;

        if ($count==0) {
            return true;
        }
    }
}
