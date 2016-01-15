<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "veiculo".
 *
 * @property integer $renavam
 * @property string $cidade
 * @property string $chassi
 * @property integer $num_patrimonio
 * @property string $lotacao
 * @property string $status
 * @property string $observacao
 * @property string $adquirido_de
 * @property string $uf_atual
 * @property string $uf_anterior
 * @property string $placa_atual
 * @property string $placa_anterior
 * @property integer $potencia
 * @property integer $id_modelo
 * @property integer $id_cor
 * @property integer $id_tipo_combustivel
 * @property integer $ano_fabricacao
 * @property integer $ano_modelo
 * @property integer $capacidade_passageiros
 *
 * @property Abastecimento[] $abastecimentos
 * @property Manutencao[] $manutencaos
 * @property RespostaSolicitacao[] $respostaSolicitacaos
 * @property Cor $idCor
 * @property Modelo $idModelo
 * @property TipoCombustivel $idTipoCombustivel
 */
class Veiculo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $id_status_bkp;

    public static function tableName()
    {
        return 'veiculo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['renavam', 'cidade', 'chassi', 'status', 'uf_atual', 'placa_atual', 'id_modelo', 'id_cor', 'id_tipo_combustivel', 'ano_fabricacao', 'ano_modelo', 'capacidade_passageiros'], 'required'],
            [['renavam', 'num_patrimonio', 'id_modelo', 'id_cor', 'id_tipo_combustivel', 'ano_fabricacao', 'ano_modelo', 'capacidade_passageiros'], 'integer'],
            [['cidade'], 'string', 'max' => 35],
            [['potencia'], 'string', 'max' => 10],
            [['chassi'], 'string', 'max' => 18],
            [['lotacao'], 'string', 'max' => 30],
            [['status'], 'string', 'max' => 25],
            [['observacao', 'adquirido_de'], 'string', 'max' => 400],
            [['uf_atual', 'uf_anterior'], 'string', 'max' => 2],
            [['placa_atual', 'placa_anterior'], 'string', 'max' => 9]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'renavam' => 'Renavam',
            'cidade' => 'Cidade',
            'chassi' => 'Chassi',
            'num_patrimonio' => 'Número de  Patrimônio',
            'lotacao' => 'Lotação',
            'status' => 'Status',
            'observacao' => 'Observação',
            'adquirido_de' => 'Adquirido De',
            'uf_atual' => 'UF Atual',
            'uf_anterior' => 'UF Anterior',
            'placa_atual' => 'Placa Atual',
            'placa_anterior' => 'Placa Anterior',
            'potencia' => 'Potência',
            'id_modelo' => 'Modelo',
            'id_cor' => 'Cor',
            'id_tipo_combustivel' => 'Tipo de Combustível',
            'ano_fabricacao' => 'Ano de Fabricação',
            'ano_modelo' => 'Ano do Modelo',
            'capacidade_passageiros' => 'Capacidade de Passageiros'
        ];
    }

    public static function getStatus(){
        return [
            '1' => 'Leiloado',
            '2' => 'Disponível',
            '3' => 'Alocado',
            '4' => 'Manutenção'
        ];
    }

    public function findStatus($id){
        switch ($id) {
            case '1':
                return 'Leiloado';
                break;

            case '2':
                return 'Disponível';
                break;

            case '3':
                return 'Alocado';
                break;

            case '4':
                return 'Manutenção';
                break;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbastecimentos()
    {
        return $this->hasMany(Abastecimento::className(), ['id_veiculo' => 'renavam']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManutencaos()
    {
        return $this->hasMany(Manutencao::className(), ['id_veiculo' => 'renavam']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespostaSolicitacaos()
    {
        return $this->hasMany(RespostaSolicitacao::className(), ['id_veiculo' => 'renavam']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCor()
    {
        return $this->hasOne(Cor::className(), ['id' => 'id_cor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdModelo()
    {
        return $this->hasOne(Modelo::className(), ['id' => 'id_modelo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoCombustivel()
    {
        return $this->hasOne(TipoCombustivel::className(), ['id' => 'id_tipo_combustivel']);
    }

    public  function afterFind(){

        //$this->id_cor_bkp = $this->id_cor;
        $this->id_status_bkp = $this->status;

        //$this->id_cor = Cor::findOne($this->id_cor)->nome;
        //$this->id_tipo_combustivel = TipoCombustivel::findOne($this->id_tipo_combustivel)->nome;
        //$this->id_modelo = Modelo::findOne($this->id_modelo)->nome;
        //SELECT * FROM solicitacao AS s WHERE s.id_veiculo=2147483647

        $connection = \Yii::$app->db;
        $model = $connection->createCommand("SELECT * FROM solicitacao WHERE id_veiculo='$this->renavam'");
        $solicitacao = $model->queryAll();

        foreach ($solicitacao as $reg):
            $status_solicitacao = "{$reg['status']}";
            $data_saida = "{$reg['data_saida']}";
            $hoje = date("Y-m-d");

            //exibe veículo alocado quando uma solicitacao aceita possui data de saida igual a data do sistema
            if ($hoje==$data_saida && $status_solicitacao=='Aceita') {
                $this->status='3';
            }

        endforeach;

        switch ($this->status){
            case '1':
                $this->status = 'Leiloado';
                break;

            case '2':
                $this->status = 'Disponível';
                break;

            case '3':
                $this->status = 'Alocado';
                break;

            case '4':
                $this->status = 'Manutenção';
                break;

        }
    }

    public function beforeDelete(){
        /*
        if ($this->isAttributeRequired(false)) {
            return true;
        }
        return false;*/
        $connection = \Yii::$app->db;
        $m = $connection->createCommand("SELECT * FROM solicitacao WHERE id_veiculo='$this->renavam'");
        $solicitacoes=$m->queryAll();
        $count=0;

        foreach ($solicitacoes as $reg):
            $count++;
        endforeach;

        if ($count==0) {
            return true;
        }
    }
}
