<?php
/**
 * Created by PhpStorm.
 * User: taibe
 * Date: 27.04.2021
 * Time: 13:48
 */

namespace api\modules\v1\forms\space;

use common\models\space\SpaceRoom;

class SpaceRoomForm
{
    public static function get($space)
    {
        return SpaceRoom::find()
            ->select(
                ['space_room.id',
                'space_room.name',
                    'space_room.is_del',
                    ]
            )
            ->joinWith('places')
            ->where([
                'space_room.space_id' => $space,
                'space_room.is_del' => 0
            ])
            ->asArray()
            ->all();
    }

    public static function one($id)
    {
        return SpaceRoom::findOne($id);
    }


}