<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\inventory\Inventory */

$this->title = 'Добавление';
$this->params['breadcrumbs'][] = ['label' => 'Инвентаризация', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
