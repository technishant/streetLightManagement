<?php

namespace console\controllers;

use yii\console\Controller;
use backend\components\StreetLightServer;
use backend\models\Devices;
use backend\models\DeviceLogs;

/**
 * Hello controller
 */
class TestController extends Controller {

    public function actionIndex() {
        $test = new StreetLightServer();
    }

    public function actionRemoveDevice() {
        while (1) {
            $deviceModel = Devices::find()->all();
            foreach ($deviceModel as $device) {
                $deviceLogs = DeviceLogs::find()->where(['device_id' => $device->id])->orderBy(['id' => SORT_DESC])->one();
                if (empty($deviceLogs)) {
                    $device->status = 0;
                    $device->server_id = NULL;
                    if ($device->save()) {
                        echo "Device with id " . $device->controller_id . " Successfully offlined \n";
                    } else {
                        print_r($device);
                    }
                } else {
                    $deviceTime = date("Y-m-d H:i:s", strtotime($deviceLogs->created . " +1 minute"));
                    if (strtotime($deviceTime) < strtotime(date("Y-m-d H:i:s"))) {
                        $device->status = 0;
                        $device->server_id = NULL;
                        if ($device->save()) {
                            echo date("Y-m-d H:i:s", strtotime($deviceTime))." = ". date("Y-m-d H:i:s")."\n";
                            echo "Device with id " . $device->controller_id . " Successfully offlined \n";
                        } else {
                            print_r($device->getErrors());
                        }
                    } else {
                        echo "Device with id " . $device->controller_id . " is Online. \n";
                    }
                }
            }
            sleep(10);
        }
    }

}
