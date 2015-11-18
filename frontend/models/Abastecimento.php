<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "abastecimento".
 *
 * @property integer $id
 * @property double $preco_litro
 * @property integer $id_posto
 * @property integer $id_veiculo
 * @property integer $km
 * @property string $data_lancamento
 * @property string $id_motorista
 * @property string $data_abastecimento
 *
 * @property Motorista $idMotorista
 * @property PostoAbastecimento $idPosto
 * @property Veiculo $idVeiculo
 */
class Abastecimento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'abastecimento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['preco_litro'], 'number'],
            [['id_posto', 'id_veiculo', 'km', 'data_lancamento', 'id_motorista'], 'required'],
            [['id_posto', 'id_veiculo', 'km'], 'integer'],
            [['data_lancamento', 'data_abastecimento'], 'safe'],
            [['id_motorista'], 'string', 'max' => 11]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'preco_litro' => 'Preco Litro',
            'id_posto' => 'Id Posto',
            'id_veiculo' => 'Id Veiculo',
            'km' => 'Km',
            'data_lancamento' => 'Data Lancamento',
            'id_motorista' => 'Id Motorista',
            'data_abastecimento' => 'Data Abastecimento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMotorista()
    {
        return $this->hasOne(Motorista::className(), ['cnh' => 'id_motorista']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPosto()
    {
        return $this->hasOne(PostoAbastecimento::className(), ['id' => 'id_posto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdVeiculo()
    {
        return $this->hasOne(Veiculo::className(), ['renavam' => 'id_veiculo']);
    }
}
