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
    public $veiculo;
    public $modelo;
    public $usuario;

    public function rules()
    {
        return [
            [['id', 'id_usuario', 'capacidade_passageiros', 'id_veiculo'], 'integer'],
            [[ 'id_usuario','veiculo','usuario','modelo','destino', 'data_saida', 'hora_saida', 'data_lancamento', 'observacao', 'status', 'endeeco_destino', 'hora_chegada', 'id_motorista', 'seguro'], 'safe'],
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
        $query->joinWith('idVeiculo');
        $query->joinWith('idUsuario');

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

        $dataProvider->sort->attributes['user'] = [
            'asc' => ['usuario.id_departamento' => SORT_ASC],
            'desc' => ['usuario.id_departamento' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $departamento = Yii::$app->user->identity->id_departamento;
        //$this->data_saida = date('Y-m-d', strtotime($this->data_saida));

        if ($departamento!=1) {

            $query->andFilterWhere([
                'id' => $this->id,
                'data_saida' => $this->data_saida,
                'data_lancamento' => $this->data_lancamento,
                'id_usuario' => Yii::$app->getUser()->id,
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
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'veiculo.placa_atual', $this->veiculo])
            ->andFilterWhere(['like', 'veiculo.id_modelo', $this->modelo]);

        //$this->data_saida = date('d-m-Y', strtotime($this->data_saida));
        return $dataProvider;
    }
}
