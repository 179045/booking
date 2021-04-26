<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\space\SpaceRoom */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="space-room-form">

    <?php $form = ActiveForm::begin([ 'enableClientValidation' => true,
                'options'                => [
                    'id'      => 'dynamic-form'
                 ]]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
