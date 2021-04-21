<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\user\User;

/* @var $this yii\web\View */
/* @var $model common\models\inventory\Inventory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventory-form row">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-6">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'serial')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-6">
        <?= $form->field($model, 'quantity')->textInput(['type' => 'number']) ?>

        <?= $form->field($model, 'sum')->textInput(['type' => 'number', 'maxlength' => true]) ?>

        <?= $form->field($model, 'space_id')->widget(Select2::className(), [
            'data' => User::getSpacesList(),
            'options' => ['placeholder' => 'Выберите заведение'],
        ]) ?>

    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
