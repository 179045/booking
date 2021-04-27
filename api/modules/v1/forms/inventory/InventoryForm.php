<?php
/**
 * Created by PhpStorm.
 * User: taibe
 * Date: 27.04.2021
 * Time: 13:48
 */

namespace api\modules\v1\forms\inventory;


use common\models\inventory\Inventory;

class InventoryForm
{
    public static function get($space)
    {
        return Inventory::find()
            ->where([
                'space_id' => $space
            ])
            ->asArray()
            ->all();
    }

    public static function one($id)
    {
        return Inventory::findOne($id);
    }


}