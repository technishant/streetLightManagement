<?php

namespace console\controllers;

use yii\console\Controller;
use backend\components\StreetLightServer;
/**
 * Hello controller
 */
class TestController extends Controller {

    public function actionIndex() {
        $test = new StreetLightServer();
    }

}
