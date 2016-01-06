<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Motorista;

/**
 * MotoristaSearch represents the model behind the search form about `app\models\Motorista`.
 */
class MotoristaSearch extends Motorista
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'categoria_cnh', 'tipo', 'status'], 'safe'],
            [['cnh', 'telefone'], 'integer'],
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
        $query = Motorista::find();

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
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'categoria_cnh', $this->categoria_cnh])
            ->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'cnh', $this->cnh]);

        return $dataProvider;
    }
}
