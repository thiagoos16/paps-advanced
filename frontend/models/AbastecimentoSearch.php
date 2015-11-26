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
    public function rules()
    {
        return [
            [['id', 'id_posto', 'id_veiculo', 'km'], 'integer'],
            [['data_lancamento', 'id_motorista', 'data_abastecimento', 'qty_litro', 'id_combustivel'], 'safe'],
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

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_posto' => $this->id_posto,
            'id_veiculo' => $this->id_veiculo,
            'km' => $this->km,
            'data_lancamento' => $this->data_lancamento,
            'data_abastecimento' => $this->data_abastecimento,
            'id_combustivel' => $this->id_combustivel,
            'qty_litro' => $this->qty_litro,
        ]);

        $query->andFilterWhere(['like', 'id_motorista', $this->id_motorista]);

        return $dataProvider;
    }
}
