<?php

namespace backend\components;

include_once 'Connection.php';
include_once 'Server.php';
include_once 'Socket.php';

use backend\models\Devices;
use backend\models\DeviceLogs;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StreetLightServer
 *
 * @author Nishant Goel
 */
class StreetLightServer {

    const BAD_DATA = 0;
    const DATA_RECEIVED_LOGGED = 1;

    private $connections = array(); // Array to save 
    public $server;

    public function __construct() {
        $this->server = new Server('ec2-52-89-229-139.us-west-2.compute.amazonaws.com', 5005, false);
        $this->server->setMaxClients(100);
        $this->server->setCheckOrigin(false);
        $this->server->setAllowedOrigin('192.168.1.153');
        $this->server->setMaxConnectionsPerIp(100);
        $this->server->setMaxRequestsPerMinute(2000);
        $this->server->setHook($this);
        $this->server->run();
    }

    /* Fired when a socket trying to connect */

    public function onConnect($connection_id) {
        $this->connections[] = $connection_id;
        echo "\nOn connect called : $connection_id \n";
        return true;
    }

    /* Fired when a socket disconnected */

    public function onDisconnect($connection_id) {

        $device = Devices::find()->where(['server_id' => $connection_id])->one();
        if (!empty($device)) {
            $device->status = 0;
            $device->save();
        }

        if (isset($this->connections[$connection_id])) {
            unset($this->connections[$connection_id]);
        }
    }

    /* Fired when data received */

    public function onDataReceive($connection_id, $data) {

        echo "\nData received from $connection_id :" . $data;
        $this->decodeData($connection_id, $data);

        if (isset($data['action'])) {
            $action = 'action_' . $data['action'];
            if (method_exists($this, $action)) {
                unset($data['action']);
                $this->$action($connection_id, $data);
            } else {
                echo "\n Caution : Action handler '$action' not found!";
            }
        }
    }

    /* Used to send data to particular connection */

    public function sendDataToConnection($connection_id, $action, $data) {
        $this->server->sendData($connection_id, $action, $data);
    }

    public function action_register($connection_id, $data) {
        $this->connections[$connection_id] = max($this->connections) + 1;

        $data = array();
        $data['user_id'] = $this->connections[$connection_id];
        $data['users_online'] = count($this->connections);
        $this->server->sendData($connection_id, 'registred', $data);
    }

    public function action_chat_text($connection_id, $data) {
        $user_id = $this->connections[$connection_id];

        if (isset($data['chat_text']) && strlen($data['chat_text']) > 0) {
            $data['date_time'] = date('H:i:s');
            foreach ($this->connections as $key => $value) {
                $this->server->sendData($key, 'chat_text', $data);
            }
        }
    }

    public function decodeData($connection_id, $data) {

        if (strlen($data) == 11) {
            echo "Data Received \n";
            $data = strtolower(bin2hex($data));
            $data = trim($data);
            echo $data . "\n";
            $deviceModel = Devices::find()->where(['controller_id' => substr($data, 2, 6)])->one();
            if (!empty($deviceModel)) {
                $deviceJunk = new \backend\models\DeviceJunk;
                $deviceJunk->region_id = $deviceModel->region_id;
                $deviceJunk->device_id = $deviceModel->id;
                $deviceJunk->device_data = $data;
                if ($deviceJunk->save()) {
                    echo "Data Logged";
                } else {
                    echo "Data not logged";
                }
//                $deviceModel->server_id = $connection_id;
//                $deviceModel->status = 1;
//                if($deviceModel->save()) {
//                    $logModel = new DeviceLogs;
//                    $logModel->region_id = $deviceModel->region_id;
//                    $logModel->device_id = $deviceModel->id;
//                    $logModel->current_voltage = substr($data, 10, 2);
//                    $logModel->current_load = substr($data, 12, 2);
//                    $logModel->voltage_status = 0;
//                    $logModel->power_status = 0;
//                    $logModel->controller_data_status = 0;
//                    $logModel->light_status = 0;
//                    $logModel->save();
//                }
            } else {
                echo "\nNo device found with id :" . substr($data, 2, 6);
            }
        } else {
            echo "\nBad Data From $connection_id :" . bin2hex($data);
            echo "\n";
            var_dump($data);
            $data = 404;
            $this->sendDataToConnection($connection_id, "BAD DATA", $data);
        }
    }

    public function hex2ascii($str) {
        $p = '';
        for ($i = 0; $i < strlen($str); $i = $i + 2) {
            $p .= chr(hexdec(substr($str, $i, 2)));
        }
        return $p;
    }

}
