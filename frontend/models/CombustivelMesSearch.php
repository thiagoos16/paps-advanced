<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\CombustivelMes;

/**
 * CombustivelMesSearch represents the model behind the search form about `frontend\models\CombustivelMes`.
 */
class CombustivelMesSearch extends CombustivelMes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_combustivel', 'mes', 'ano'], 'integer'],
            [['valor'], 'number'],
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
        $query = CombustivelMes::find();

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
            'id_combustivel' => $this->id_combustivel,
            'mes' => $this->mes,
            'ano' => $this->ano,
            'valor' => $this->valor,
        ]);

        return $dataProvider;
    }
}
