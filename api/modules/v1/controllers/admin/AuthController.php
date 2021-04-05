<?php
namespace api\modules\v1\controllers\admin;

use app\modules\v1\forms\admin\auth\LoginForm;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;
use yii\web\Response;

/**
 * Created by PhpStorm.
 * User: taibe
 * Date: 05.04.2021
 * Time: 21:38
 */

class AuthController extends Controller
{
    public function behaviors()
    {
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className()
        ];

        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'except'=>['login','login-api', 'get-reporting-username', 'OPTIONS']
        ];

        return $behaviors;
    }

    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            return parent::beforeAction($action);
        } catch (BadRequestHttpException $e) {
        }
    }

    public function actionLogin()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new LoginForm();
        $model->username = Yii::$app->request->post('username');
        $model->password = Yii::$app->request->post('password');

        if ( $model->login() ) {

            $response["token"] = Yii::$app->user->identity->auth_key;
            return $response;
        }

        Yii::$app->response->statusCode = 401;
        return $model->getErrors();
    }
}