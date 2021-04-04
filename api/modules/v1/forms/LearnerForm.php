<?php

namespace app\modules\v1\forms;

use Yii;
use yii\base\Model;

class LearnerForm extends Model
{
    public $id;
    public $name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name'], 'string'],
        ];
    }

    public static function getLearnerCurrGroup() {
        $sqlQuery = \Yii::$app->db->createCommand('SELECT tbl.id AS id,
            CONCAT_WS(" ", tbl.surname, tbl.name) AS name
        FROM learner AS tbl
            LEFT JOIN `group` AS tbg ON tbg.id = tbl.group_id
            WHERE tbg.is_active = 1;');

        //выполняем запрос
        $resultSelect = $sqlQuery->query();
        //получаем все строки разом в виде массива
        $response = [];
        foreach ($resultSelect->readAll() as $learner){
            $item['id'] = (int) $learner['id'];
            $item['name'] = $learner['name'];
            $response[] = $item;
        }
        return $response;
    }
}
