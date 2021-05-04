<?php
/**
 * Created by PhpStorm.
 * User: taibe
 * Date: 28.04.2021
 * Time: 16:49
 */

namespace api\modules\v1\forms\reference;


use common\models\customer\TypeCustomer;
use common\models\user\User;
use Yii;

class TypeCustomerForm
{

    public static function get($space)
    {
        return TypeCustomer::find()
            ->select([
                'id as value',
                'name as label'
            ])
            ->where([
                'is_del' => 0,
                'space_id' => $space
            ])
            ->asArray()
            ->all();
    }
}