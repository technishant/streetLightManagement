<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body pd-0">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    'power',
                    'light_source',
                    'warranty',
                    'input_voltage',
                    'load_capacity',
                    'high_cut',
                    'low_cut',
                    'case',
                    'body_color',
                    'ip_grade',
                    'created',
                    'quality_approved',
                    'place_of_origin',
                    'created_by',
                ],
            ])
            ?>
        </div>
    </div>
</div>
