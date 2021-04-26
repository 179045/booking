<?php
/**
 * Created by PhpStorm.
 * User: taibe
 * Date: 25.04.2021
 * Time: 18:05
 */

namespace api\modules\v1\forms\user;


use common\models\user\User;
use common\models\user\UserProfile;
use Yii;
use yii\base\Model;
use yii\rbac\DbManager;

class SpaceUserFrom extends Model
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
            try {
                $dbm->assign($dbm->getRole('manager'), $user->id);
            } catch (\Exception $e) {
            }
            return true;
        }else{
            return false;
        }
    }



    public static function get()
    {
        return User::find()
            ->select([
                'user.id',
                'username',
                'user_profile.fio',
                'user_profile.position',
                'space_id',
                'company_id'
            ])
            ->leftJoin('user_profile', 'user_profile.user_id = user.id')
            ->where(
                [
//                    'is_del' => 0,
                    'space_id' => User::findOne(\Yii::$app->user->getId())->space_id
                ]
            )
            ->asArray()
            ->all();
    }
}