<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Region */

$this->title = 'Create Region';
$this->params['breadcrumbs'][] = ['label' => 'Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>