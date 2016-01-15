<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $observacao;
    public $nome;
    public $confirma_senha;
    public $id_departamento;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required', 'message'=>'Este campo é obrigatório'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Username existente no sistema'],
            ['username', 'string', 'min' => 2, 'max' => 255],


            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message'=>'Este campo é obrigatório'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Email existente no sistema'],

            ['password', 'required', 'message' => 'Este campo é obrigatório'],
            ['password', 'string', 'min' => 6],

            [['nome', 'confirma_senha', 'id_departamento'], 'required', 'message'=>'Este campo é obrigatório'],
            [['id_departamento'], 'integer'],
            [['nome'], 'string', 'max' => 60],
            [['observacao'], 'string', 'max' => 200],
            [['confirma_senha'], 'string', 'max' => 45],
            ['nome', 'match', 'pattern'=>'/^[a-zA-Z\s]{1,60}$/'],
            ['email', 'match', 'pattern'=>'/^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+@{1}[a-zA-Z0-9_.-]*\\.+[a-z]{2,4}/'],
            ['username', 'match', 'pattern'=>'/^[a-z0-9_-]{1,45}$/'],
            [['confirma_senha'], 'compare', 'compareAttribute' => 'password', 'message' => 'Repita sua Senha']
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->nome = $this->nome;
            $user->observacao = $this->observacao;
            $user->confirma_senha = $this->confirma_senha;
            $user->id_departamento = $this->id_departamento;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'email' => 'Email',
            'password' => 'Senha',
            'confirma_senha' => 'Confirmar a Senha',
            'nome_usuario' => 'Nome de Usuário',
            'observacao' => 'Observação',
            'id_departamento' => 'Departamento',
            'username' => 'Nome de Usuário',
        ];
    }

    public function getPrompt(){
        return ['prompt'=>'Selecione uma opção'];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDepartamento()
    {
        return $this->hasOne(Departamento::className(), ['id' => 'id_departamento']);
    }
}
