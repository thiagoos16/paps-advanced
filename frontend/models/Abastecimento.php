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
 * @property TipoCombustivel $id_combustivel
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
            [['id_posto', 'id_veiculo', 'km', 'id_motorista', 'id_combustivel', 'valor_abastecido', 'qty_litro'], 'required', 'message' => 'Este campo é obrigatório'],
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
            'id_posto' => 'Posto',
            'id_veiculo' => 'Veículo',
            'km' => 'Quilometragem',
            'data_lancamento' => 'Data de Lançamento',
            'id_motorista' => 'Motorista',
            'data_abastecimento' => 'Data de Abastecimento',
            'id_combustivel' => 'Combustível',
            'qty_litro' => 'Quantidade de litros',
            'valor_abastecido' => 'Valor Abastecido'
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCombustivel()
    {
        return $this->hasOne(TipoCombustivel::className(), ['id' => 'id_combustivel']);
    }

    public function afterFind()
    {
        $this->id_combustivel = TipoCombustivel::findOne($this->id_combustivel)->nome;
        $this->id_posto = PostoAbastecimento::findOne($this->id_posto)->nome;
        $this->id_veiculo = Veiculo::findOne($this->id_veiculo)->placa_atual;
        $this->data_lancamento = date('d-m-Y h:i:s', strtotime($this->data_lancamento));
        $this->data_abastecimento = date('d-m-Y', strtotime($this->data_abastecimento));
    }

    public  function beforeSave($insert){
        if (parent::beforeSave($insert)){
            $this->data_abastecimento = date('Y-m-d', strtotime($this->data_abastecimento));
            return true;
        }
        else {
            return false;
        }
    }
}
