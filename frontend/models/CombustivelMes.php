<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "combustivel_mes".
 *
 * @property integer $id_combustivel
 * @property integer $mes
 * @property integer $ano
 * @property double $valor
 *
 * @property TipoCombustivel $idCombustivel
 */
class CombustivelMes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $mes_bkp;
    public static function tableName()
    {
        return 'combustivel_mes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_combustivel', 'mes', 'ano','valor'], 'required'],
            //[['id_combustivel', 'mes', 'ano'], 'unique', "message"=>"Mês/Ano já existente no sistema"],
            [['id_combustivel', 'mes', 'ano'], 'unique', 'targetAttribute' => ['id_combustivel', 'mes', 'ano'], "message"=>"Mês/Ano já existente no sistema"],
            //[['id_combustivel', 'mes', 'ano'], 'integer']
            //['categoria_cnh', 'match', 'pattern'=>'/^[a-eA-E]/'],
            //[['valor'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_combustivel' => 'Combustível',
            'mes' => 'Mês',
            'ano' => 'Ano',
            'valor' => 'Preço (R$)'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCombustivel()
    {
        return $this->hasOne(TipoCombustivel::className(), ['id' => 'id_combustivel']);
    }

    public function afterFind(){
        $this->mes_bkp = $this->mes;
        $this->mes = $this->getMesId($this->mes);
    }

    public static function getMes(){
        return [
            1 =>'Janeiro',
            2 =>'Fevereiro',
            3 =>'Março',
            4 =>'Abril',
            5 =>'Maio',
            6 =>'Junho',
            7 =>'Julho',
            8 =>'Agosto',
            9 =>'Setembro',
            10=>'Outubro',
            11=>'Novembro',
            12=>'Dezembro'
        ];
    }

    public function getMesId($id){
        switch($id){
            case 1:
                return 'Janeiro';
                break;
            case 2:
                return 'Fevereiro';
                break;
            case 3:
                return 'Março';
                break;
            case 4:
                return 'Abril';
                break;
            case 5:
                return 'Maio';
                break;
            case 6 :
                return 'Junho';
                break;
            case 7 :
                return 'Julho';
                break;
            case 8 :
                return'Agosto';
                break;
            case 9 :
                return'Setembro';
                break;
            case 10 :
                return'Outubro';
                break;
            case 11 :
                return'Novembro';
                break;
            case 12 :
                return'Dezembro';
                break;
        }
    }
    public function getIdMes($mes){
        switch($mes){
            case 'Janeiro':
                return 1;
                break;
            case 'Fevereiro':
                return 2;
                break;
            case 'Março':
                return 3;
                break;
            case 'Abril':
                return 4;
                break;
            case 'Maio':
                return 5;
                break;
            case 'Junho' :
                return 6;
                break;
            case 'Julho' :
                return 7;
                break;
            case 'Agosto' :
                return 8;
                break;
            case 'Setembro' :
                return 9;
                break;
            case 'Outubro' :
                return 10;
                break;
            case 'Novembro' :
                return 11;
                break;
            case 'Dezembro' :
                return 12;
                break;
        }
    }

    public  function beforeSave($insert){
        if (parent::beforeSave($insert)){
            $this->ano = $this->after(' - ', $this->mes);
            $this->mes = $this->before(' - ', $this->mes);

            $this->valor= str_replace(",",".",$this->valor);
            return true;
        }
        else {
            return false;
        }
    }

    function after ($a, $inthat)
    {
        if (!is_bool(strpos($inthat, $a)))
            return substr($inthat, strpos($inthat,$a)+strlen($a));
    }

    function before ($a, $inthat)
    {
        return substr($inthat, 0, strpos($inthat, $a));
    }

    public function afterSave($insert)
    {


        $sql = "
            UPDATE abastecimento
              SET abastecimento.valor_abastecido = $this->valor * abastecimento.qty_litro
              WHERE
                YEAR(abastecimento.data_abastecimento) = $this->mes AND
                MONTH(abastecimento.data_abastecimento)= $this->ano AND
            abastecimento.id_combustivel = $this->id_combustivel";

        $connection = \Yii::$app->db->createCommand($sql)->execute();
        echo "<script> alert('$connection'); </script>";

    }
}
