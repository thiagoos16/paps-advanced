<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "solicitacao".
 *
 * @property integer $id
 * @property string $destino
 * @property string $hora_saida
 * @property string $data_hora
 * @property string $observacao
 * @property string $status
 * @property integer $id_usuario
 * @property integer $capacidade_passageiros
 *
 * @property RespostaSolicitacao $respostaSolicitacao
 * @property Usuario $idUsuario
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
            [['destino', 'hora_saida', 'status', 'id_usuario', 'capacidade_passageiros'], 'required'],
            [['hora_saida', 'data_hora'], 'safe'],
            [['id_usuario', 'capacidade_passageiros'], 'integer'],
            [['destino', 'observacao'], 'string', 'max' => 45],
            [['status'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'destino' => 'Destino',
            'hora_saida' => 'Hora Saida',
            'data_hora' => 'Data Hora',
            'observacao' => 'Observacao',
            'status' => 'Status',
            'id_usuario' => 'Id Usuario',
            'capacidade_passageiros' => 'Capacidade Passageiros',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespostaSolicitacao()
    {
        return $this->hasOne(RespostaSolicitacao::className(), ['id_solicitacao' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'id_usuario']);
    }
}
