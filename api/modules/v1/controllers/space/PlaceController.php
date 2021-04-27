<?php
/**
 * Created by PhpStorm.
 * User: taibe
 * Date: 27.04.2021
 * Time: 13:46
 */

namespace api\modules\v1\controllers\space;


use api\modules\v1\forms\space\PlaceForm;
use common\models\space\Place;
use common\models\user\User;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

class PlaceController extends Controller
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

    public function actionIndex($space_room_id)
    {
        return PlaceForm::get($space_room_id);
    }

    public function actionView($id)
    {
        return PlaceForm::one($id);
    }

    public function actionCreate()
    {
        $model = new Place();
        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            return $model;
        }else{
            $this->response->setStatusCode(400);
            return [
                'message' => 'Ошибка при сохранении',
                'errors' => $model->getErrors()
            ];
        }
    }

    public function actionUpdate($id)
    {
        try {
            $model = $this->findModel($id);
        } catch (NotFoundHttpException $e) {
            $this->response->setStatusCode(404);
            return [
                'message' => 'Запись не найдена',
            ];
        }
        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            return $model;
        }
        $this->response->setStatusCode(400);
        return [
            'message' => 'Ошибка при сохранении',
            'errors' => $model->getErrors()
        ];
    }

    public function actionDelete($id)
    {
        try {
            $model = $this->findModel($id);
        } catch (NotFoundHttpException $e) {
            $this->response->setStatusCode(404);
            return [
                'message' => 'Запись не найдена',
            ];
        }

        $model->is_del = 1;
        if ($model->save()){
            return [
                'message' => 'Успешно удалено'
            ];
        }

        $this->response->setStatusCode(400);
        return [
            'message' => 'Ошибка при сохранении',
            'errors' => $model->getErrors()
        ];
    }

    /**
     * Finds the Inventory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Place the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Place::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}