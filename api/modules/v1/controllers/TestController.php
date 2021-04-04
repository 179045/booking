<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class TestController extends Controller
{
    public function behaviors()
    {
//        $behaviors = parent::behaviors();
//        $behaviors['authenticator'] = [
//            'class' =>  HttpBearerAuth::className(),
//        ];
//        return $behaviors;
        $behaviors = parent::behaviors();

        if(isset($behaviors['authenticator'])){
            $behaviors['authenticator']['except'] = ['index'];
        }
        return $behaviors;
    }

    public function actionTest(){
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return 0;

    }
}


