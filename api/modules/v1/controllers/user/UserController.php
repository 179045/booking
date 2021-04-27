<?php
/**
 * Created by PhpStorm.
 * User: taibe
 * Date: 25.04.2021
 * Time: 17:59
 */

namespace api\modules\v1\controllers\user;


use api\modules\v1\forms\user\SpaceUserForm;
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
        return SpaceUserForm::get();
    }

    public function actionCreate($space = null)
    {
        $model = new SpaceUserForm();
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

    public function actionUpdate($id, $space = null)
    {
        $user = User::findOne($id);
        if($user == null){
            $this->response->setStatusCode(404);
            return [
                'message' => 'Пользователь не найден',
            ];
        }
        $model = new SpaceUserForm();
        if ($model->load(Yii::$app->request->post(), '')&& $model->validate() && $model->update($id)) {
            return $model;
        }else {
            $this->response->setStatusCode(400);
            return [
                'message' => 'Ошибка при сохранении',
                'errors' => $model->getErrors()
            ];
        }
    }

    public function actionDelete($id)
    {
        $user = User::findOne($id);
        if($user == null){
            $this->response->setStatusCode(404);
            return [
                'message' => 'Пользователь не найден',
            ];
        }
        $model = new SpaceUserForm();
        if ($model->delete($id)) {
            return $model;
        }
        $this->response->setStatusCode(400);
        return [
            'message' => 'Ошибка при удалении',
            'errors' => $model->getErrors()
        ];
    }

    public function actionView($id)
    {

        return SpaceUserForm::one($id);

    }

}