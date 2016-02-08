<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DevicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Devices';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?>  <a href="<?= yii\helpers\Url::to(['devices/create']); ?>"><i class="fa fa-plus pull-right"></i></a></h3>
        </div>
        <div class="panel-body pd-0">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'region_id',
                    'controller_id',
                    'type',
                    'latitude',
                    // 'longitude',
                    // 'sim_number',
                    // 'imei_number',
                    // 'contact_1_name',
                    // 'contact__1_phone',
                    // 'contact_1_email:email',
                    // 'contact_2_name',
                    // 'contact_2_phone',
                    // 'contact_2_email:email',
                    // 'created',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>

        </div>
    </div>
</div>