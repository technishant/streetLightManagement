<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RegionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Device Overview';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body pd-0">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'layout' => "{items}\n{pager}",
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'controller_id',
                        'value' => 'controller_id'
                    ],
                    [
                        'attribute' => 'current_voltage',
                        'label' => 'Current Voltage (V)'
                    ],
                    [
                        'attribute' => 'current_load',
                        'value' => 'current_load',
                        'label' => 'Current Voltage (KW)'
                    ],
                    [
                        'attribute' => 'voltage_status',
                        'value' => 'voltage_status'
                    ],
                    [
                        'attribute' => 'light_status',
                        'value' => 'light_status'
                    ],
                    [
                        'attribute' => 'overload_status',
                        'value' => 'overload_status'
                    ],
                    [
                        'attribute' => 'created',
                        'label' => 'Last Synced'
                    ],
                    [
                        'attribute' => 'status',
                        'label' => 'Device Status',
                        'format' => 'raw',
                        'value' => function ($row) {
                            if ($row['status'] == "Online") {
                                return Html::tag('span', $row['status'], ['class' => 'green']);
                            } else {
                                return Html::tag('span', $row['status'], ['class' => 'red']);
                            }
                        }
                            ],
                        ],
                    ]);
                    ?>

        </div>
    </div>
</div>