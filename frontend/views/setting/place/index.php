<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\space\PlaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Столы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="place-index">

    <p>
        <?= Html::a('Добавить стол', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'quantity',
            'number',
            'is_del',
            //'space_room_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
