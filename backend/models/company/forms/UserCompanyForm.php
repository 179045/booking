<?php

namespace backend\models\company\forms;
use common\models\user\User;
use common\models\user\UserHasCompany;
use yii\base\Model;

/**
 * Created by PhpStorm.
 * User: taibe
 * Date: 11.04.2021
 * Time: 19:11
 */

class UserCompanyForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $company_id;

    private $_user;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email', 'company_id'], 'required'],
            [['username', 'password', 'email'], 'string'],
            [['company_id'], 'integer'],
        ];
    }

    public function create(){

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if($user->save()){
            $userHasCompany = new UserHasCompany();
            $userHasCompany->user_id = $user->id;
            $userHasCompany->company_id = $this->company_id;
            $userHasCompany->save();
        }else {
            $this->addErrors($user->getErrors());
        }

        return true;
    }
}