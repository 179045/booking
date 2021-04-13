<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\space\Space */

$this->title = 'Create Space';
$this->params['breadcrumbs'][] = ['label' => 'Spaces', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="space-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
