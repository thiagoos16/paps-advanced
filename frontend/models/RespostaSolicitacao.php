<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "resposta_solicitacao".
 *
 * @property integer $id_solicitacao
 * @property string $hora_chegada
 * @property string $id_motorista
 * @property integer $id_veiculo
 * @property string $Seguro
 *
 * @property Motorista $idMotorista
 * @property Solicitacao $idSolicitacao
 * @property Veiculo $idVeiculo
 */
class RespostaSolicitacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'resposta_solicitacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_solicitacao', 'id_motorista', 'id_veiculo'], 'required'],
            [['id_solicitacao', 'id_veiculo'], 'integer'],
            [['hora_chegada'], 'safe'],
            [['id_motorista'], 'string', 'max' => 11],
            [['Seguro'], 'string', 'max' => 55]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_solicitacao' => 'Id Solicitacao',
            'hora_chegada' => 'Hora Chegada',
            'id_motorista' => 'Id Motorista',
            'id_veiculo' => 'Id Veiculo',
            'Seguro' => 'Seguro',
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
    public function getIdSolicitacao()
    {
        return $this->hasOne(Solicitacao::className(), ['id' => 'id_solicitacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdVeiculo()
    {
        return $this->hasOne(Veiculo::className(), ['renavam' => 'id_veiculo']);
    }
}
