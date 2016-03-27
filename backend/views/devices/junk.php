<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Devices;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->title = 'Device Junk Data';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body pd-0" id="device-overview-container">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'layout' => "{items}\n{pager}",
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    ['attribute' => 'device_id',
                        'label' => 'Controller ID',
                        'value' => function($row) {
                            return Devices::find()->where(['id' => $row->device_id])->one()->controller_id;
                        }],
                            ['attribute' => 'device_data', 'label' => 'Device Data'],
                            ['attribute' => 'created', 'label' => 'Logging Time']
                        ],
                    ]);
                    ?>
        </div>
    </div>
</div>