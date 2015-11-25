<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $nome
 * @property string $observacao
 * @property string $confirma_senha
 * @property integer $id_departamento
 *
 * @property Departamento $idDepartamento
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at', 'nome', 'confirma_senha', 'id_departamento'], 'required'],
            [['status', 'created_at', 'updated_at', 'id_departamento'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['nome'], 'string', 'max' => 100],
            [['observacao'], 'string', 'max' => 200],
            [['confirma_senha'], 'string', 'max' => 45],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Nome de Usuario',
            'auth_key' => 'Chave do Autor',
            'password_hash' => 'Senha',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Creado por ',
            'updated_at' => 'Atualizado At',
            'nome' => 'Nome Completo',
            'observacao' => 'Observação',
            'confirma_senha' => 'Confirma Senha',
            'id_departamento' => 'Departamento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDepartamento()
    {
        return $this->hasOne(Departamento::className(), ['id' => 'id_departamento']);
    }
}
