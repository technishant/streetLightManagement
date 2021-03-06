<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>

    <body>
        <input type="hidden" id="load-devices-on-map" value="<?= Url::to(['site/load-devices-on-map'])?>">
        <?php $this->beginBody() ?>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= Url::to(['site/dashboard']); ?>"><?= Html::encode('Electro Tech') ?></a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= Yii::$app->user->identity->username; ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?= Url::to(['/site/logout']); ?>" data-method="post"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <?php $controller = Yii::$app->controller->id;  ?>
                <?php $action = Yii::$app->controller->action->id;  ?>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li class="<?= ($action == 'dashboard') ? 'active' : '' ?>">
                            <a href="<?= Url::to(['site/dashboard']); ?>"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li class="<?= ($controller == 'product') ? 'active' : '' ?>">
                            <a href="<?= Url::to(['product/index']); ?>"><i class="fa fa-fw fa-bar-chart-o"></i> Products</a>
                        </li>
                        <li class="<?= ($controller == 'region') ? 'active' : '' ?>">
                            <a href="<?= Url::to(['region/index']); ?>"><i class="fa fa-fw fa-table"></i> Regions</a>
                        </li>
                        <li class="<?= ($controller == 'product') ? 'devices' : '' ?>">
                            <a href="<?= Url::to(['devices/index']); ?>"><i class="fa fa-fw fa-edit"></i> Devices</a>
                        </li>
                        <li class="<?= ($action == 'device-overview') ? 'active' : '' ?>">
                            <a href="<?= Url::to(['site/device-overview']); ?>"><i class="fa fa-fw fa-eye"></i> Device Overview</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>

            <div id="page-wrapper">

                <?= $content ?>

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>