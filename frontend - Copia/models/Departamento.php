<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "departamento".
 *
 * @property integer $id
 * @property string $nome
 *
 * @property Usuario[] $usuarios
 */
class Departamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departamento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required', 'message'=>'Este campo é obrigatório'],
            [['nome'], 'string', 'max' => 45],
            [['nome'], 'unique', 'message'=>'Departamento já cadastrado no sistema']
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
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['id_departamento' => 'id']);
    }
}
