<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DevicesSetting */

$this->title = 'Create Devices Setting';
$this->params['breadcrumbs'][] = ['label' => 'Devices Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="devices-setting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
