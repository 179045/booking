<?php

namespace app\modules\v1\forms;


use common\models\Answer;
use common\models\AnswerSession;
use Yii;
use yii\base\Model;

class SaveAnswerForm extends Model
{
    public $learner_session, $question_session, $answer;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['learner_session', 'question_session', 'answer'], 'required'],
            [['learner_session', 'question_session', 'answer'], 'integer'],

        ];
    }

    public function saveAnswer() {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $model = AnswerSession::find()
                ->where(['question_session_id' => $this->question_session])
                ->andWhere(['learner_session_id' => $this->learner_session])
                ->one();

            if ($model == null) {
                $model = new AnswerSession();
            }

            $model->question_session_id = $this->question_session;
            $model->learner_session_id = $this->learner_session;
            $model->select_answer_id = $this->answer;

            if ($model->save()) {
                $transaction->commit();

                return true;
            }
        } catch (\Exception $e) {
            $this->addError('Database Errors', 'Database transaction failed!');
            $transaction->rollBack();
        }
    }
}