<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\RespostaSolicitacao;

/**
 * RespostaSolicitacaoSearch represents the model behind the search form about `frontend\models\RespostaSolicitacao`.
 */
class RespostaSolicitacaoSearch extends RespostaSolicitacao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_solicitacao', 'id_veiculo'], 'integer'],
            [['hora_chegada', 'id_motorista', 'Seguro'], 'safe'],
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
        $query = RespostaSolicitacao::find();

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
            'id_solicitacao' => $this->id_solicitacao,
            'hora_chegada' => $this->hora_chegada,
            'id_veiculo' => $this->id_veiculo,
        ]);

        $query->andFilterWhere(['like', 'id_motorista', $this->id_motorista])
            ->andFilterWhere(['like', 'Seguro', $this->Seguro]);

        return $dataProvider;
    }
}
