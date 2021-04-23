<?php
/**
 * Created by PhpStorm.
 * User: taibe
 * Date: 23.04.2021
 * Time: 10:17
 */

namespace frontend\models\forms\user;


use common\models\user\User;
use common\models\user\UserProfile;
use Yii;
use yii\base\Model;
use yii\rbac\DbManager;

class CreateUserForm extends Model
{

    public $username;
    public $fio;
    public $position;
    public $password;
    public $company_id;
    public $space_id;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\user\User', 'message' => 'Имя пользователя занято. Выберите другое имя пользователя.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            [['fio', 'position'], 'required'],
            [['fio', 'position'], 'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'fio' => 'ФИО',
            'position' => 'Должность',
        ];
    }

    public function create()
    {
        $user = new User();
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->space_id = $this->space_id;
        $user->company_id = $this->company_id;

        $user_profile = new UserProfile();
        $user_profile->fio = $this->fio;
        $user_profile->position = $this->position;
        $user_profile->user = $user;

        if ($user_profile->save()){
            $dbm = new DbManager;
            $dbm->assign($dbm->getRole('manager'), $user->id);
            return true;
        }else{
            return false;
        }



    }
}