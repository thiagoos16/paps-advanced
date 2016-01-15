<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Manutencao;

/**
 * ManutencaoSearch represents the model behind the search form about `app\models\Manutencao`.
 */
class ManutencaoSearch extends Manutencao
{
    /**
     * @inheritdoc
     */
    public $veiculo;
    public $modelo;

    public function rules()
    {
        return [
            [['id', 'id_veiculo', 'km'], 'integer'],
            [['data_entrada', 'servico', 'data_saida', 'tipo', 'data_lancamento', 'id_motorista','veiculo','modelo'], 'safe'],
            [['custo'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Manutencao::find();
        $query->joinWith(['idVeiculo']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['veiculo'] = [
            'asc' => ['veiculo.placa_atual' => SORT_ASC],
            'desc' => ['veiculo.placa_atual' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['modelo'] = [
            'asc' => ['veiculo.id_modelo' => SORT_ASC],
            'desc' => ['veiculo.id_modelo' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'data_entrada' => date('Y-m-d', strtotime($this->data_entrada)) == "1970-01-01"? $this->data_entrada:date('Y-m-d', strtotime($this->data_entrada)),
            //'data_entrada' => $this->data_entrada ,
            //date('d-m-Y', strtotime($this->data_saida));
            //'data_saida' => date('d-m-Y',strtotime($this->data_saida)),
            'data_saida' => $this->data_saida,
            'id_veiculo' => $this->id_veiculo,
            'veiculo.id_modelo' => $this->modelo,
            'km' => $this->km,
        ]);

        $query->andFilterWhere(['like', 'servico', $this->servico])
            ->andFilterWhere(['like', 'custo', $this->custo])
            ->andFilterWhere(['like', 'id_motorista', $this->id_motorista])
            ->andFilterWhere(['like', 'veiculo.placa_atual', $this->veiculo])
            ->andFilterWhere(['like', 'veiculo.id_modelo', $this->modelo])
            //->andFilterWhere(['like', 'data_entrada', date('Y-m-d', strtotime($this->data_entrada))])

        ;

        return $dataProvider;
    }
}
