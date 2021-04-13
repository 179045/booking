<?php

namespace backend\controllers\company;

use backend\models\company\forms\UserCompanyForm;
use Yii;
use common\models\user\UserHasCompany;
use common\models\user\UserHasCompanySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for UserHasCompany model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserHasCompany models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserHasCompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserHasCompany model.
     * @param integer $user_id
     * @param integer $company_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($user_id, $company_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($user_id, $company_id),
        ]);
    }

    /**
     * Creates a new UserHasCompany model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($company_id)
    {
        $model = new UserCompanyForm();
        $model->company_id = $company_id;
        if ($model->load(Yii::$app->request->post()) && $model->create()) {
            return $this->redirect(['company/company/view', 'id' => $company_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserHasCompany model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $user_id
     * @param integer $company_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($user_id, $company_id)
    {
        $model = $this->findModel($user_id, $company_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'company_id' => $model->company_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserHasCompany model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $user_id
     * @param integer $company_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($user_id, $company_id)
    {
        $this->findModel($user_id, $company_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserHasCompany model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $user_id
     * @param integer $company_id
     * @return UserHasCompany the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $company_id)
    {
        if (($model = UserHasCompany::findOne(['user_id' => $user_id, 'company_id' => $company_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
