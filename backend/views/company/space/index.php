<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $company common\models\company\Company */
/* @var $searchModel common\models\space\SpaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заведения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="space-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Создать заведение', ['company/space/create', 'company_id' => $company->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'average_score',
            'space_type_id',
            'city_id',
            'telephone',
            'address',
            'description',
            'is_del',
            //'company_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
