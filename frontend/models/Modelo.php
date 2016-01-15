<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "modelo".
 *
 * @property integer $id
 * @property string $nome
 * @property integer $id_marca
 *
 * @property Marca $idMarca
 * @property Veiculo[] $veiculos
 */
class Modelo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $id_bkp;

    public static function tableName()
    {
        return 'modelo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'id_marca'], 'required', "message"=>"Este campo é obrigatório"],
            [['id_marca'], 'integer'],
            [['nome'], 'string', 'max' => 30],
            [['nome'], 'unique', 'targetAttribute' => ['nome'], "message"=>"Modelo existente no sistema"]
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
            'id_marca' => 'Nome da Marca',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMarca()
    {
        return $this->hasOne(Marca::className(), ['id' => 'id_marca']);
    }

    public function getPrompt(){
        return ['prompt'=>'Selecione uma opção'];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVeiculos()
    {
        return $this->hasMany(Veiculo::className(), ['id_modelo' => 'id']);
    }

    public  function afterFind(){
        $this->id_bkp = $this->id_marca;
        $this->id_marca = Marca::findOne($this->id_marca)->nome;

    }


    public function beforeDelete(){

        $connection = \Yii::$app->db;
        $m = $connection->createCommand("SELECT * FROM veiculo WHERE id_modelo='$this->id'");
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
