<?php
/**
 * Created by PhpStorm.
 * User: taibe
 * Date: 27.04.2021
 * Time: 13:48
 */

namespace api\modules\v1\forms\space;

use common\models\space\Place;

class PlaceForm
{
    public static function get($space_room)
    {
        return Place::find()
            ->where([
                'is_del' => 0,
                'space_room_id' => $space_room
            ])
            ->asArray()
            ->all();
    }

    public static function one($id)
    {
        return Place::findOne($id);
    }


}