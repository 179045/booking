<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\inventory\InventorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Инвентаризация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-index">

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'serial',
            'number',
            'quantity',
            //'sum',
            //'company_id',
            //'date_created',
            //'date_updated',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>


</div>
