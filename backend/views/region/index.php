<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RegionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Regions';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?>  <a href="<?= yii\helpers\Url::to(['region/create']); ?>"><i class="fa fa-plus pull-right"></i></a></h3>
        </div>
        <div class="panel-body pd-0">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'layout'=>"{items}\n{pager}",
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    'address',
                    'city',
                    'state',
                    // 'country',
                    // 'postcode',
                    // 'created',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>

        </div>
    </div>
</div>