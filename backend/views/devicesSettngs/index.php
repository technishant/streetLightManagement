<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DevicesSettingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Devices Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="devices-setting-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Devices Setting', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'region_id',
            'device_id',
            'high_cut',
            'low_cut',
            // 'overload',
            // 'mode',
            // 'time',
            // 'date',
            // 'created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
