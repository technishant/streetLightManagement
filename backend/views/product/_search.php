<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'power') ?>

    <?= $form->field($model, 'light_source') ?>

    <?= $form->field($model, 'warranty') ?>

    <?php // echo $form->field($model, 'input_voltage') ?>

    <?php // echo $form->field($model, 'load_capacity') ?>

    <?php // echo $form->field($model, 'high_cut') ?>

    <?php // echo $form->field($model, 'low_cut') ?>

    <?php // echo $form->field($model, 'case') ?>

    <?php // echo $form->field($model, 'body_color') ?>

    <?php // echo $form->field($model, 'ip_grade') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'quality_approved') ?>

    <?php // echo $form->field($model, 'place_of_origin') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
