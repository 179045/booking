<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Response;
use app\modules\v1\forms\TestSessionForm;

/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class TestSessionController extends Controller
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

    public function actionListByLearner($learner_id) {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $form = new TestSessionForm();
        $form->learner_id = $learner_id;
        $responseArr = $form->getTestSessionByLearner();

        //отправляем данные
        return $responseArr;
    }
}
