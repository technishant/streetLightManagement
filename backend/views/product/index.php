<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?>  <a href="<?= yii\helpers\Url::to(['product/create']); ?>"><i class="fa fa-plus pull-right"></i></a></h3>
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
                    'power',
                    'light_source',
                    'warranty',
                    // 'input_voltage',
                    // 'load_capacity',
                    // 'high_cut',
                    // 'low_cut',
                    // 'case',
                    // 'body_color',
                    // 'ip_grade',
                    // 'created',
                    // 'quality_approved',
                    // 'place_of_origin',
                    // 'created_by',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>
    </div>
</div>
