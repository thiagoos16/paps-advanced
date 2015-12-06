<?php

namespace frontend\models;

use common\models\User;
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
            [['capacidade_passageiros'], 'integer'],
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
            'id' => 'N° da Solicitação',
            'destino' => 'Destino',
            'hora_saida' => 'Hora de Saida',
            'data_hora' => 'Data de Lançamento no sistema',
            'observacao' => 'Observação',
            'status' => 'Status',
            'id_usuario' => 'Usuário',
            'capacidade_passageiros' => 'Número de Passageiros',
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

    public function getStatus(){
        return [
            '1' => 'Em análise',
            '2' => 'Aceita',
            '3' => 'Rejeitada'
        ];
    }

    public function afterFind()
    {
        $this->id_usuario = User::findOne($this->id_usuario)->nome;

        switch ($this->status){
            case '1':
                $this->status = 'Em análise';
                break;

            case '2':
                $this->status = 'Aceita';
                break;

            case '3':
                $this->status = 'Rejeitada';
                break;
        }
    }
}
