<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Response;
use app\modules\v1\forms\LearnerForm;

/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class LearnerController extends Controller
{
    public function behaviors()
    {
//        $behaviors = parent::behaviors();
//        $behaviors['authenticator'] = [
//            'class' =>  HttpBearerAuth::className(),
//        ];
//        return $behaviors;
        $behaviors = parent::behaviors();

        //if(isset($behaviors['authenticator'])){
//            $behaviors['authenticator']['except'] = ['index'];
//        }
        return $behaviors;
    }

    public function actionList() {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $responseArr = LearnerForm::getLearnerCurrGroup();

        //отправляем данные
        return $responseArr;
    }
}
