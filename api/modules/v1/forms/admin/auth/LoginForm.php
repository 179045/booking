<?php

namespace app\modules\v1\forms\admin\auth;

use common\models\user\User;
use yii\base\Model;

/**
 * Created by PhpStorm.
 * User: taibe
 * Date: 05.04.2021
 * Time: 21:45
 */

class LoginForm extends Model
{
    public $username;
    public $password;
    public $token;

    /**
     * @var User
     */
    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // password is validated by validatePassword()
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
    public function validatePassword($attribute, $params)
    {
        //Костыль для авторизации айпада
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate() ) {
            if(!$this->_user->auth_key) {
                $this->_user->generateToken();
            } else {
                \Yii::$app->user->login($this->_user);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }
}