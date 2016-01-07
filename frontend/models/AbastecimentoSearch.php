<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Abastecimento;

/**
 * AbastecimentoSearch represents the model behind the search form about `app\models\Abastecimento`.
 */
class AbastecimentoSearch extends Abastecimento
{
    /**
     * @inheritdoc
     */
    public $posto;
    public function rules()
    {
        return [
            [['id', 'id_veiculo', 'km'], 'integer'],
            [['data_lancamento', 'id_posto', 'posto', 'id_motorista', 'data_abastecimento', 'qty_litro', 'id_combustivel'], 'safe'],
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
        $query = Abastecimento::find();

        $query->joinWith('idPosto');
        $query->joinWith('idVeiculo');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['posto'] = [
            'asc' => ['posto_abastecimento.nome' => SORT_ASC],
            'desc' => ['posto_abastecimento.nome' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        //$this->data_abastecimento = date('Y-m-d', strtotime($this->data_abastecimento));

        $query->andFilterWhere([
            'qty_litro' => $this->qty_litro,
        ]);

        $query->andFilterWhere(['like', 'id_motorista', $this->id_motorista])
            ->andFilterWhere(['like','posto_abastecimento.nome', $this->posto])
            ->andFilterWhere(['like','veiculo.placa_atual', $this->id_veiculo]);

        //$this->data_abastecimento = date('d-m-Y', strtotime($this->data_abastecimento));
        return $dataProvider;
    }
}
