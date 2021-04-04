<?php

namespace app\modules\v1\forms;

use common\models\LearnerSession;
use yii\base\Model;

class LearnerSessionForm extends Model
{
    public $id;
    public $learner_id;
    public $test_session_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['learner_id'], 'required'],
            [['id', 'learner_id', 'test_session_id'], 'integer'],
        ];
    }

    public function createLearnerSession() {
        /*
         * 2020-11-02 Данная проверка потеряла силу, так как
         * нам заказали не ограничивать пользователя в попытках.
        //проверяем не выбран ли ранее данный пользователь
        $count = LearnerSession::find()
            ->where(['learner_id' => $this->learner_id])
            ->andWhere(['test_session_id' => $this->test_session_id])
            ->count();

        if ($count == 0) {
        */

        //делаем поиск существующей не завершенной сессии
        $model = LearnerSession::find()
            ->where(['learner_id' => $this->learner_id])
            ->andWhere(['test_session_id' => $this->test_session_id])
            ->andWhere(['end_time' => null])
            ->one();

        if ($model == null) {
            //если не найден, создаем новую сессию
            $model = new LearnerSession();
            $model->learner_id = $this->learner_id;
            $model->test_session_id = $this->test_session_id;
            $model->start_time = date('Y-m-d H:i:s');

            if ($model->save()) {
                $this->id = $model->id;

                return [
                    'status'=>1
                ];
            } else {
                return [
                    'status'=>0,
                    'messages'=>$model->getErrors()
                ];
            }
        } else {
            $this->id = $model->id;

            return [
                'status'=>1
            ];
        }



            /*
        } else {
            return [
                'status'=>0,
                'messages'=>'Выбранный пользователь уже начал тестирование!'
            ];
        }
            */
    }
}
