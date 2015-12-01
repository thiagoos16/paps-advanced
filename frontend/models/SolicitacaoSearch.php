<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Solicitacao;

/**
 * SolicitacaoSearch represents the model behind the search form about `frontend\models\Solicitacao`.
 */
class SolicitacaoSearch extends Solicitacao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_usuario', 'capacidade_passageiros'], 'integer'],
            [['destino', 'hora_saida', 'data_hora', 'observacao', 'status'], 'safe'],
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
        $query = Solicitacao::find();

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
            'hora_saida' => $this->hora_saida,
            'data_hora' => $this->data_hora,
            'id_usuario' => $this->id_usuario,
            'capacidade_passageiros' => $this->capacidade_passageiros,
        ]);

        $query->andFilterWhere(['like', 'destino', $this->destino])
            ->andFilterWhere(['like', 'observacao', $this->observacao])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
