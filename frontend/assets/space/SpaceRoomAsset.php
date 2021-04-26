<?php

namespace frontend\assets\space;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class SpaceRoomAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'bootstrap/css/bootstrap-table.min.css'
    ];
    public $js = [
        'bootstrap/js/popper.min.js',
        'bootstrap/js/bootstrap-table.min.js',
        'space/js/space-room.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
