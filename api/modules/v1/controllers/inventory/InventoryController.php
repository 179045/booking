<?php
/**
 * Created by PhpStorm.
 * User: taibe
 * Date: 27.04.2021
 * Time: 13:46
 */

namespace api\modules\v1\controllers\inventory;


use api\modules\v1\forms\inventory\InventoryForm;
use common\models\inventory\Inventory;
use common\models\user\User;
use Yii;
use yii\db\StaleObjectException;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

class InventoryController extends Controller
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
        return InventoryForm::get($space ? $space : User::findOne(Yii::$app->user->getId())->space_id);
    }

    public function actionView($id)
    {
        return InventoryForm::one($id);
    }

    public function actionCreate($space = null)
    {
        $model = new Inventory();
        $model->date_created = date('Y-m-d');
        $model->space_id = User::findOne(Yii::$app->user->getId())->space_id;
        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            return $model;
        }
        $this->response->setStatusCode(400);
        return [
            'message' => 'Ошибка при сохранении',
            'errors' => $model->getErrors()
        ];
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
        $model->date_updated = date('Y-m-d');
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
        try {
            $model->delete();
            return [
                'message' => 'Успешно удалено'
            ];
        } catch (StaleObjectException $e) {
        } catch (\Throwable $e) {
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
     * @return Inventory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Inventory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}