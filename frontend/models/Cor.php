<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cor".
 *
 * @property integer $id
 * @property string $nome
 *
 * @property Veiculo[] $veiculos
 */
class Cor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required', 'message'=>'Este campo é obrigatório'],
            [['nome'], 'string', 'max' => 15],
            [['nome'], 'unique', 'message'=>'Cor já cadastrada no sistema']
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
    public function getVeiculos()
    {
        return $this->hasMany(Veiculo::className(), ['id_cor' => 'id']);
    }
}
