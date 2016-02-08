<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DevicesSetting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="devices-setting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'region_id')->textInput() ?>

    <?= $form->field($model, 'device_id')->textInput() ?>

    <?= $form->field($model, 'high_cut')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'low_cut')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'overload')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mode')->textInput() ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
