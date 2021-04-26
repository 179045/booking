<?php
/**
 * Created by PhpStorm.
 * User: taibe
 * Date: 25.04.2021
 * Time: 17:59
 */

namespace api\modules\v1\controllers\user;


use api\modules\v1\forms\user\SpaceUserFrom;
use common\models\user\User;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;


class UserController extends Controller
{
    public function behaviors()
    {
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className()
        ];

        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];

        return $behaviors;
    }

    public function actionGetSpaceUsers()
    {
        return SpaceUserFrom::get();
    }

    public function actionCreate($space = null)
    {
        $model = new SpaceUserFrom();
        $user = User::findOne(Yii::$app->user->getId());
        $model->company_id = $user->company_id;
        if ($space){
            $model->space_id = $space;
        }else {
            $model->space_id = $user->space_id;
        }
        if ($model->load(Yii::$app->request->post(), '') && $model->create()) {
            return $model;
        }
         $this->response->setStatusCode(400);
        return [
            'message' => 'Ошибка при сохранении',
            'errors' => $model->getErrors()
        ];
    }

}