<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\space\SpaceRoom */

$this->title = 'Создание';
$this->params['breadcrumbs'][] = ['label' => 'Залы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="space-room-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
