<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "solicitacao".
 *
 * @property integer $id
 * @property string $destino
 * @property string $data_saida
 * @property string $hora_saida
 * @property string $data_lancamento
 * @property string $observacao
 * @property string $status
 * @property integer $id_usuario
 * @property integer $capacidade_passageiros
 * @property string $endeeco_destino
 * @property string $hora_chegada
 * @property string $id_motorista
 * @property integer $id_veiculo
 * @property string $seguro
 *
 * @property Motorista $idMotorista
 * @property Usuario $idUsuario
 * @property Veiculo $idVeiculo
 */
class Solicitacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'solicitacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['destino', 'data_saida', 'hora_saida', 'status', 'id_usuario', 'capacidade_passageiros'], 'required'],
            [['data_saida', 'data_lancamento'], 'safe'],
            [['id_usuario', 'capacidade_passageiros', 'id_veiculo'], 'integer'],
            [['destino', 'endeeco_destino'], 'string', 'max' => 45],
            [['hora_saida', 'status', 'hora_chegada'], 'string', 'max' => 15],
            [['observacao'], 'string', 'max' => 100],
            [['id_motorista'], 'string', 'max' => 11],
            [['seguro'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'N° da Solicitação',
            'destino' => 'Destino',
            'data_saida' => 'Data da Saida',
            'hora_saida' => 'Hora da Saida',
            'data_lancamento' => 'Data de Lancamento',
            'observacao' => 'Observação',
            'status' => 'Status',
            'id_usuario' => 'Usuário',
            'capacidade_passageiros' => 'Número de Passageiros',
            'endeeco_destino' => 'Endereço do Destino',
            'hora_chegada' => 'Hora da Chegada',
            'id_motorista' => 'Motorista',
            'id_veiculo' => 'Veiculo',
            'seguro' => 'Seguro',
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
    public function getIdUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdVeiculo()
    {
        return $this->hasOne(Veiculo::className(), ['renavam' => 'id_veiculo']);
    }

    public static function getStatus(){
        return ["Em análise" => "Em análise",
            "Aceita" => "Aceita",
            "Rejeitada" => "Rejeitada"];
    }

    public static function getPrompt(){
        return ['prompt'=>'Selecione uma opção'];
    }
}
