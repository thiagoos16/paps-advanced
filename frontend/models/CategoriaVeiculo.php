<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "categoria_veiculo".
 *
 * @property integer $id
 * @property string $nome
 *
 * @property Solicitacao[] $solicitacaos
 */
class CategoriaVeiculo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoria_veiculo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitacaos()
    {
        return $this->hasMany(Solicitacao::className(), ['id_categoria' => 'id']);
    }
}
