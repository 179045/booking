<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\user\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <p>
        <?= Html::a('Добавить', ['create', 'space' => Yii::$app->request->get('UserSearch')['space_id']], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    if(Yii::$app->user->can('director')) {
        echo $this->render('_search', ['model' => $searchModel]);
    }?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'userProfile.fio',
            'userProfile.position',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
