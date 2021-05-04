<?php
/**
 * Created by PhpStorm.
 * User: taibe
 * Date: 28.04.2021
 * Time: 14:45
 */
namespace api\modules\v1\controllers\customer;

use api\modules\v1\forms\customer\CustomerForm;
use common\models\customer\Customer;
use common\models\user\User;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;

class CustomerController extends Controller
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

    public function actionIndex($space = null)
    {
        return CustomerForm::get($space ? $space : User::findOne(Yii::$app->user->getId())->space_id);
    }

    public function actionUpdate($id, $space = null)
    {
        $customer = Customer::findOne($id);
        if($customer == null){
            $this->response->setStatusCode(404);
            return [
                'message' => 'Пользователь не найден',
            ];
        }
        $model = new CustomerForm();
        if ($model->load(Yii::$app->request->post(), '')&& $model->validate() && $model->update($id, $space ? $space : User::findOne(Yii::$app->user->getId())->space_id)) {
            return $model;
        }else {
            //$this->response->setStatusCode(400);
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
        $model = new CustomerForm();
        if ($model->delete($id)) {
            return $model;
        }
        $this->response->setStatusCode(400);
        return [
            'message' => 'Ошибка при удалении',
            'errors' => $model->getErrors()
        ];
    }

    public function actionView($id, $space = null)
    {

        return CustomerForm::one($id, $space ? $space : User::findOne(Yii::$app->user->getId())->space_id);

    }
}