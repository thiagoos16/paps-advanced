<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LockscreenForm extends Model
{
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // password is validated by validatePassword()
            //['password', 'validatePassword'],
            [['password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */

    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            $user = User::findOne(Yii::$app->getUser()->id);
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Informe a senha correta.');
            }
        }

        //$this->addError($attribute, 'Informe a senha correta.');
        //$this->addError($attribute, 'Informe a senha correta.');
    }


}









