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
            [['id', 'id_usuario', 'capacidade_passageiros', 'id_veiculo'], 'integer'],
            [['destino', 'data_saida', 'hora_saida', 'data_lancamento', 'observacao', 'status', 'endeeco_destino', 'hora_chegada', 'id_motorista', 'seguro'], 'safe'],
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
        $departamento = Yii::$app->user->identity->id_departamento;

        if ($departamento!=1) {
            $query->andFilterWhere([
                'id' => $this->id,
                'data_saida' => $this->data_saida,
                'data_lancamento' => $this->data_lancamento,
                'id_usuario' => $this->id_usuario,
                'capacidade_passageiros' => $this->capacidade_passageiros,
                'id_veiculo' => $this->id_veiculo,
            ]);
        }
        else {
            $query->andFilterWhere([
                'id' => $this->id,
            ]);
        }

        $query->andFilterWhere(['like', 'destino', $this->destino])
            ->andFilterWhere(['like', 'data_saida', $this->data_saida])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
