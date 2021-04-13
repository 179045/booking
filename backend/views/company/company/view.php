<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\company\Company */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Компании', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="company-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description',
            'is_del',
        ],
    ]) ?>
    <?php /* заведения */ ?>
    <?= $this->render(
            '../space/index',
            [
                'company' => $model,
                'dataProvider' => $spaceDataProvider,
                'searchModel' => $spaceSearchModel,
            ]
    )?>

    <?php /* пользователи */ ?>
    <?= $this->render(
        '../user/index',
        [
            'company' => $model,
            'dataProvider' => $userDataProvider,
            'searchModel' => $userSearchModel,
        ]
    )?>

</div>
