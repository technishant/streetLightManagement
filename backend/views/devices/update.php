<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Devices */

$this->title = 'Update Devices: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Devices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="devices-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
