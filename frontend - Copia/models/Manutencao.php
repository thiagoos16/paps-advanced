<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "manutencao".
 *
 * @property integer $id
 * @property string $data_entrada
 * @property string $servico
 * @property double $custo
 * @property string $data_saida
 * @property string $tipo
 * @property string $data_lancamento
 * @property integer $id_veiculo
 * @property integer $km
 * @property string $id_motorista
 *
 * @property Motorista $idMotorista
 * @property Veiculo $idVeiculo
 */
class Manutencao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manutencao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'servico', 'custo', 'tipo', 'data_lancamento', 'id_veiculo', 'km', 'id_motorista'], 'required'],
            [['id', 'id_veiculo', 'km'], 'integer'],
            [['data_entrada', 'data_saida', 'data_lancamento'], 'safe'],
            [['custo'], 'number'],
            [['servico'], 'string', 'max' => 45],
            [['tipo'], 'string', 'max' => 25],
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
            'data_entrada' => 'Data de Entrada',
            'servico' => 'Serviço',
            'custo' => 'Custo',
            'data_saida' => 'Data de Saída',
            'tipo' => 'Tipo',
            'data_lancamento' => 'Data de Lançamento',
            'id_veiculo' => 'Id Veículo',
            'km' => 'Kilometragem do Veículo',
            'id_motorista' => 'Id Motorista',
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
    public function getIdVeiculo()
    {
        return $this->hasOne(Veiculo::className(), ['renavam' => 'id_veiculo']);
    }
}
