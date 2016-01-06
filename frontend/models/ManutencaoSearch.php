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
    public function rules()
    {
        return [
            [['id', 'id_veiculo', 'km'], 'integer'],
            [['data_entrada', 'servico', 'data_saida', 'tipo', 'data_lancamento', 'id_motorista'], 'safe'],
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
            'data_entrada' => $this->data_entrada,
            //date('d-m-Y', strtotime($this->data_saida));
            //'data_saida' => date('d-m-Y',strtotime($this->data_saida)),
            'data_saida' => $this->data_saida,
            'id_veiculo' => $this->id_veiculo,
            'km' => $this->km,
        ]);

        $query->andFilterWhere(['like', 'servico', $this->servico])
            ->andFilterWhere(['like', 'custo', $this->custo])
            ->andFilterWhere(['like', 'id_motorista', $this->id_motorista])
            //->andFilterWhere(['like', 'data_saida', date('d-m-Y', strtotime($this->data_saida))])
        ;

        return $dataProvider;
    }
}
