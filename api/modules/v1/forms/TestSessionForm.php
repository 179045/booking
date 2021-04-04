<?php

namespace app\modules\v1\forms;

use common\models\TestSession;
use yii\base\Model;

class TestSessionForm extends Model
{
    public $id;
    public $learner_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['learner_id'], 'required'],
            [['id', 'learner_id'], 'integer'],
        ];
    }

    public function getTestSessionByLearner() {
        $sqlQuery = \Yii::$app->db->createCommand('SELECT tbts.id,
            tbt.name
        FROM test_session AS tbts
            LEFT JOIN test AS tbt ON tbt.id = tbts.test_id
            LEFT JOIN learner AS tbl ON tbl.group_id = tbts.group_id
            WHERE tbl.id = '. $this->learner_id .'
            AND tbts.finish_time IS NULL
            ORDER BY tbt.name;');

        //выполняем запрос
        $resultSelect = $sqlQuery->query();
        //получаем все строки разом в виде массива
        return $resultSelect->readAll();
    }
}
