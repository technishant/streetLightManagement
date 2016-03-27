<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use backend\models\Devices;
use backend\models\DeviceLogs;
use yii\helpers\ArrayHelper;
use backend\components\Helper;
use yii\data\ArrayDataProvider;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'dashboard', 'load-devices-on-map', 'device-overview'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('dashboard');
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionDashboard() {
        $this->layout = "dashboard";
        return $this->render('dashboard');
    }

    public function actionLoadDevicesOnMap() {
        if (Yii::$app->request->isAjax) {
            $model = Devices::find()->all();
            $response = array("status" => 1);
            if (!empty($model)) {
                $data = array();
                foreach ($model as $device) {
                    $temp = array();
                    $temp['controller_id'] = $device->controller_id;
                    $temp['latitude'] = $device->latitude;
                    $temp['longitude'] = $device->longitude;
                    $temp['sim_number'] = $device->sim_number;
                    $temp['imei_number'] = $device->imei_number;
                    $temp['status'] = $device->status;
                    $deviceLogs = DeviceLogs::find()->where(['device_id' => $device->id])->orderBy(['id' => SORT_DESC])->one();
                    if (!empty($deviceLogs)) {
                        $temp['logs'] = [
                            'current_voltage' => $deviceLogs->current_voltage,
                            'current_load' => isset($deviceLogs->current_load) ? $deviceLogs->current_load/10 : $deviceLogs->current_load,
                            'voltage_status' => Helper::voltageStatus($deviceLogs->voltage_status),
                            'light_status' => Helper::lightStatus($deviceLogs->light_status),
                            'overload_status' => Helper::overloadStatus($deviceLogs->overload_status),
                            'created' => date("d-M-Y H:i:s", strtotime($deviceLogs->created)),
                        ];
                    } else {
                        $temp['logs'] = array();
                    }
                    $data[] = $temp;
                }
                $response["data"] = $data;
            } else {
                $response = array("status" => 0, "data" => array());
            }
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $response;
        }
    }

    public function actionDeviceOverview() {
        $deviceModel = Devices::find()->all();
        $this->layout = "dashboard";
        $response = array();
        foreach ($deviceModel as $device) {
            $temp = array();
            $deviceLogs = DeviceLogs::find()->where(['device_id' => $device->id])->orderBy(['id' => SORT_DESC])->one();
            $temp['id'] = $device->id;
            $temp['controller_id'] = $device->controller_id;
            $temp['sim_number'] = $device->sim_number;
            $temp['status'] = ($device->status == 1) ? "Online" : "Offline";
            if (!empty($deviceLogs)) {
                $temp['current_voltage'] = $deviceLogs->current_voltage;
                $temp['current_load'] = isset($deviceLogs->current_load) ? $deviceLogs->current_load / 10 : $deviceLogs->current_load;
                $temp['voltage_status'] = Helper::voltageStatus($deviceLogs->voltage_status);
                $temp['light_status'] = Helper::lightStatus($deviceLogs->light_status);
                $temp['overload_status'] = Helper::overloadStatus($deviceLogs->overload_status);
                $temp['created'] = date("d-M-Y H:i:s", strtotime($deviceLogs->created));
            }
            $response[] = $temp;
        }
        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $response
        ]);
        return $this->render('deviceOverview', [
                    'dataProvider' => $dataProvider
        ]);
    }

}
