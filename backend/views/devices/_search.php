<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DevicesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="devices-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'region_id') ?>

    <?= $form->field($model, 'controller_id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'sim_number') ?>

    <?php // echo $form->field($model, 'imei_number') ?>

    <?php // echo $form->field($model, 'contact_1_name') ?>

    <?php // echo $form->field($model, 'contact__1_phone') ?>

    <?php // echo $form->field($model, 'contact_1_email') ?>

    <?php // echo $form->field($model, 'contact_2_name') ?>

    <?php // echo $form->field($model, 'contact_2_phone') ?>

    <?php // echo $form->field($model, 'contact_2_email') ?>

    <?php // echo $form->field($model, 'created') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
