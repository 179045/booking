<?php

namespace app\modules\v1\forms;

use common\models\Answer;
use common\models\AnswerSession;
use common\models\LearnerSession;
use common\models\QuestionSession;
use common\models\TestSession;
use Yii;
use yii\base\Model;

class ExamForm extends Model
{
    public $learner_session;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['learner_session'], 'required'],
            [['learner_session'], 'integer'],
        ];
    }

    public function getResult() {
        $modelLearnerSession = LearnerSession::findOne($this->learner_session);
        //ставим дату и время завершения
        $modelLearnerSession->end_time = date('Y-m-d H:i:s');
        $modelLearnerSession->save();

        $sqlQuery = \Yii::$app->db->createCommand('SELECT SUM(IF(tba.is_right = 1, 1, 0)) AS correct,
            SUM(IF(tba.is_right = 0, 1, 0)) AS incorrect
        FROM answer_session AS tbas
            LEFT JOIN answer AS tba ON tba.id = tbas.select_answer_id
            WHERE tbas.learner_session_id = '.$this->learner_session.';');

        //выполняем запрос
        $resultSelect = $sqlQuery->query();
        //получаем все строки разом в виде массива
        $arrResult = $resultSelect->read();

        $result['total'] = $arrResult['correct'] + $arrResult['incorrect'];
        $result['correct'] = (int) $arrResult['correct'];
        $result['incorrect'] = (int) $arrResult['incorrect'];

        return $result;
    }

    //работа над ошибками для ученика
    public function workOnMistake() {
        $questions = [];

        $modelLearnerSession = LearnerSession::findOne($this->learner_session);

        $listModelQuestionSession = QuestionSession::find()
            ->select('question_session.id AS id, question.id AS idQuest, question.name AS name')
            ->leftJoin('question', 'question.id = question_session.question_id')
            ->where(['question_session.test_session_id' => $modelLearnerSession->test_session_id])
            ->orderBy('order ASC');

        $listModelQuestionSession = $listModelQuestionSession->asArray()->all();

        if (count($listModelQuestionSession) > 0) {
            foreach ($listModelQuestionSession as $modelQuestion) {
                $answers = [];
                $isCorrect = false;
                $question['id'] = $modelQuestion['id'];
                $question['question'] = $modelQuestion['name'];

                $listModelAnswer = Answer::find()
                    ->select('answer.id AS id, answer.name AS name, answer.is_right AS isRight')
                    ->where(['answer.question_id' => $modelQuestion['idQuest']]);

                $listModelAnswer = $listModelAnswer->asArray()->all();

                $modelAnswerSession = AnswerSession::find()
                    ->where(['question_session_id' => $modelQuestion['id']])
                    ->andWhere(['learner_session_id' => $this->learner_session])
                    ->one();

                foreach ($listModelAnswer as $modelAnswer) {
                    $answer['id'] = (int) $modelAnswer['id'];
                    $answer['text'] = $modelAnswer['name'];

                    $answer['isRight'] = false;
                    //если ответ правильный и Админ разрешил посмотреть правильные ответы,
                    // ставим отметку что ответ является правильным на заданный вопрос.
                    if ($modelAnswer['isRight'] == 1 && $modelLearnerSession->is_show_answers == 1) {
                        $answer['isRight'] = true;
                    }

                    if ($modelAnswerSession != null && $modelAnswerSession->select_answer_id ==  $modelAnswer['id']) {
                        $answer['selected'] = true;
                        if($modelAnswer['isRight'] == 1) {
                            $isCorrect = true;
                        }
                    } else {
                        $answer['selected'] = false;
                    }

                    $answers[] = $answer;
                }
                $question['correct'] = $isCorrect;
                $question['answers'] = $answers;

                $questions[] = $question;
            }
        }

        return $questions;
    }
}
