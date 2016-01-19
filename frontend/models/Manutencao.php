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
            [['servico', 'custo', 'tipo', 'id_veiculo', 'data_entrada', 'km', 'id_motorista'], 'required'],
            [['id', 'id_veiculo', 'km'], 'integer'],
            [['data_entrada', 'data_saida', 'data_lancamento'], 'safe'],
            [['custo'], 'number'],
            [['servico'], 'string', 'max' => 45],
            [['tipo'], 'string', 'max' => 25],
            [['id_motorista'], 'string', 'max' => 11],
            ['data_saida','compare','compareAttribute'=>'data_entrada','operator'=>'<=',"message"=>'A data de entrada deve ser igual ou anterior à data de saída']
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
            'id_veiculo' => 'Veículo',
            'km' => 'Quilometragem do Veículo',
            'id_motorista' => 'Motorista',
            'veiculo' => 'Veículo',
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

    public static function getTipo(){
        return [
            "Preventiva" => "Preventiva",
            "Corretiva" => "Corretiva",
            "Reparos" => "Reparos"];
    }

    public static function getPrompt(){
        return ['prompt'=>'Selecione uma opção'];
    }

    public function afterSave($insert)
    {
        Veiculo::updateAll(array('status' => 4), ['renavam' => $this->id_veiculo]);
        $this->data_lancamento = date('d-m-Y h:i:s', strtotime($this->data_lancamento));

        if ($this->data_saida!=null) {
            $this->data_saida = date('d-m-Y', strtotime($this->data_saida));
        }

        if ($this->data_entrada!=null) {
            $this->data_entrada = date('d-m-Y', strtotime($this->data_entrada));
        }

    }

    public  function beforeSave($insert){
        if (parent::beforeSave($insert)){

            if ($this->data_saida!=null) {
                $this->data_saida = date('Y-m-d', strtotime($this->data_saida));
            }

            if ($this->data_entrada!=null) {
                $this->data_entrada = date('Y-m-d', strtotime($this->data_entrada));
            }

            date_default_timezone_set('America/Manaus');
            $this->data_lancamento = date('Y-m-d h:i:s');
            return true;
        }
        else {
            return false;
        }
    }

}


