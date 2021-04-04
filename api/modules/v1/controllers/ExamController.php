<?php

namespace api\modules\v1\controllers;

use app\modules\v1\forms\ExamForm;
use app\modules\v1\forms\LearnerSessionForm;
use app\modules\v1\forms\SaveAnswerForm;
use common\models\TestSession;
use Yii;
use yii\rest\Controller;
use yii\web\Response;

/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class ExamController extends Controller
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

    //API готовит вопросы для тестируемого по заданной тест сессии
    // в этой же функции создается learner-session, а также
    // question-learner-session для хранения порядка следования вопросов
    // для каждого тестируемого
    public function actionQuestions($learner_id, $test_session_id) {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $transaction = Yii::$app->db->beginTransaction();
        try {
            //найдем сессию тестирования
            $modelTestSession = TestSession::findOne($test_session_id);

            if ($modelTestSession != null) {
                //создаем learner_session по переданному выбранному пользователю
                $formLearnerSession = new LearnerSessionForm();
                $formLearnerSession->learner_id = $learner_id;
                $formLearnerSession->test_session_id = $modelTestSession->id;
                //тут будет создана или найдена текущая не завершенная learner-session
                $result = $formLearnerSession->createLearnerSession();

                if ($result['status'] == 1) {
                    //готовим ответ
                    $response['status'] = true;
                    $response['learner_session'] = $formLearnerSession->id;
                    $response['time'] = $modelTestSession->time;
                    $response['count_quest'] = $modelTestSession->count_question;
                    $response['questions'] = $modelTestSession->getQuestions($formLearnerSession->id);

                    $transaction->commit();

                    return $response;
                } else {
                    return [
                        'status'=>false,
                        'messages'=>$result['messages']
                    ];
                }
            } else {
                return [
                    'status'=>false,
                    'messages'=>'Запущенный тест не найден!'
                ];
            }
        } catch (\Exception $e) {
            $transaction->rollBack();

            return [
                'status'=>false,
                'messages'=>'Ошибка! Обратитесь к администратору Системы. Database transaction failed!'
            ];
        }
    }

    public function actionSaveAnswer() {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $form = new SaveAnswerForm();
        $form->load(Yii::$app->request->post(), '');

        if($form->validate()) {
            return $form->saveAnswer();
        } else {
            return [
                'status'=>status,
                'messages'=>$form->getErrorSummary(true)
            ];
        }
    }

    public function actionResult($learner_session) {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $form = new ExamForm();
        $form->learner_session = $learner_session;

        return $form->getResult();
    }

    public function actionWorkOnMistake($learner_session) {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $form = new ExamForm();
        $form->learner_session = $learner_session;

        $response['learner_session'] = $learner_session;
        $response['questions'] = $form->workOnMistake();

        return $response;
    }
}


