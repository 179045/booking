<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\space\SpaceRoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Залы/столы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="space-room-index">

    <p>
        <?= Html::a('Добавить зал', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'name',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
