<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Veiculo;

/**
 * VeiculoSearch represents the model behind the search form about `app\models\Veiculo`.
 */
class VeiculoSearch extends Veiculo
{
    /**
     * @inheritdoc
     */
    public $modelo;
    public $cor;

    public function rules()
    {
        return [
            [['renavam', 'num_patrimonio', 'potencia', 'id_cor', 'id_tipo_combustivel', 'ano_fabricacao', 'ano_modelo'], 'integer'],
            [['cidade', 'modelo','cor', 'chassi', 'id_modelo', 'lotacao', 'status', 'observacao', 'adquirido_de', 'uf_atual', 'uf_anterior', 'placa_atual', 'placa_anterior'], 'safe'],
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
        $query = Veiculo::find();
        $query->joinWith('idModelo')->joinWith("idCor");
        //$query->joinWith('idModelo');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['cor'] = [
            'asc' => ['cor.nome' => SORT_ASC],
            'desc' => ['cor.nome' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['modelo'] = [
            'asc' => ['modelo.nome' => SORT_ASC],
            'desc' => ['modelo.nome' => SORT_DESC],
        ];

        //$this->load($params);

        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
              ->andFilterWhere(['like', 'renavam', $this->renavam])
              ->andFilterWhere(['like', 'placa_atual', $this->placa_atual])
              ->andFilterWhere(['like', 'modelo.nome', $this->modelo])
              ->andFilterWhere(['like', 'cor.nome', $this->cor]);

        return $dataProvider;
    }
}
