<?php
/**
 * Created by PhpStorm.
 * User: taibe
 * Date: 28.04.2021
 * Time: 16:47
 */

namespace api\modules\v1\controllers\reference;


use api\modules\v1\forms\reference\TypeCustomerForm;
use common\models\user\User;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;

class TypeCustomerController extends Controller
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
        return TypeCustomerForm::get($space ? $space : User::findOne(Yii::$app->user->getId())->space_id);
    }
}