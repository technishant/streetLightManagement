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
                'layout'=>"{items}\n{pager}",
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'controller_id',
                    'sim_number',
                    'imei_number',
                    'contact_1_name',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}{update}{delete}{junk}',
                        'buttons' => [
                            'junk' => function($url, $model, $key) {
                                return Html::a('<span class="glyphicon glyphicon-th-list"></span>', \yii\helpers\Url::toRoute([junk, 'device_id' => $key]), [
                                            'title' => Yii::t('app', 'Info'),
                                ]);
                            }
                                ]
                            ],
                        ],
                    ]);
                    ?>
        </div>
    </div>
</div>