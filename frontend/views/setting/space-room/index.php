<?php

frontend\assets\space\SpaceRoomAsset::register($this);

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\space\SpaceRoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Залы/столы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="space-room-index">
    <div class="row">
        <div class="col-6">
            <p>
                <?= Html::a('Добавить зал',
                    ['create'],
                    [
                        'class' => 'btn btn-success',
                    ]) ?>
            </p>

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <table id="myTasks"
                   data-toggle="table"
                   data-url="<?=Url::to(['setting/space-room/get-space-rooms']);?>"
                   data-pagination="true"
            >
                <thead>
                <tr>
                    <th data-formatter="runningFormatter">№</th>
                    <th data-field="name">Наименование</th>

                </tr>
                </thead>
            </table>

            <?php /*= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'id',
                    'name',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); */?>

        </div>
        <div class="col-6">
            <?php
                echo $this->render('../place/index', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel])
            ?>
        </div>
    </div>

    <?php Modal::begin([
        'id' => 'activity-modal',
        'header' => '<h4 class="modal-title"></h4>',
        'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Закрыть</a>',
    ]); ?>





</div>
