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
        //$this->server = new Server('127.0.0.1', 5005, false);
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
            $device->server_id = NULL;
            if ($device->save()) {
                echo "Device Successfully offlined";
            } else {
                echo "Device could not be offlined";
            }
        }

        if (isset($this->connections[$connection_id])) {
            unset($this->connections[$connection_id]);
        }
    }

    /* Fired when data received */

    public function onDataReceive($connection_id, $data) {

        echo "\nData received from $connection_id :" . $data;
        $this->decodeData($connection_id, $data);
        $this->sendDataToConnection($connection_id, "sas", $data);
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
        $data = strtolower(bin2hex($data));
        $data_array = array_filter(explode("ab", $data));
        if (!empty($data_array)) {
            foreach ($data_array as $key => $value) {
                if (strlen($value) == 20) {
                    $deviceModel = Devices::find()->where(['controller_id' => substr($value, 0, 6)])->one();
                    if (!empty($deviceModel)) {
                        echo "Good Data From $connection_id :" . $data . "\n";
                        $deviceModel->status = 1;
                        $deviceModel->server_id = $connection_id;
                        if ($deviceModel->save()) {
                            echo "Device Status Saved \n";
                            $deviceJunk = new \backend\models\DeviceJunk;
                            $deviceJunk->region_id = $deviceModel->region_id;
                            $deviceJunk->device_id = $deviceModel->id;
                            $deviceJunk->device_data = $value;
                            if ($deviceJunk->save()) {
                                echo "Device junk data saved on the server \n";
                                if ($this->decodeCommand($deviceModel->id, $value)) {
                                    echo "Data Logged";
                                } else {
                                    echo "Data Not llogged";
                                }
                            } else {
                                print_r($deviceJunk->getErrors());
                            }
                        } else {
                            print_r($deviceModel->getErrors());
                        }
                    } else {
                        echo "No Device could be found with id : " . substr($value, 0, 6);
                    }
                } else {
                    echo "Bad Data From $connection_id :" . $data . "\n";
                }
            }
        } else {
            echo "No Data Received \n";
        }
    }

    public function decodeCommand($deviceId, $data) {
        $command_id = substr($data, 6, 2);
        $deviceModel = Devices::find()->where(['id' => $deviceId])->one();
        switch ($command_id) {
            case "01":
                break;
            case "03":
                break;
            case "02":
                $v1 = hexdec(substr($data, 8, 2));
                $v2 = hexdec(substr($data, 10, 2));
                $voltage = ($v1 * 256) + $v2;
                $l1 = hexdec(substr($data, 14, 2));
                $l2 = hexdec(substr($data, 16, 2));
                $load = ($l1 * 256) + $l2;
                $status = base_convert(substr($data, 18, 2), 16, 2);
                $voltage_status = base_convert(substr($string, 0, 2), 2, 10);
                $light_status = base_convert(substr($string, 2, 2), 2, 10);
                $overload_staus = base_convert(substr($string, 4, 2), 2, 10);
                $deviceLogs = new DeviceLogs;
                $deviceLogs->region_id = $deviceModel->region_id;
                $deviceLogs->device_id = $deviceModel->id;
                $deviceLogs->current_voltage = $voltage;
                $deviceLogs->current_load = $load;
                $deviceLogs->voltage_status = $voltage_status;
                $deviceLogs->light_status = $light_status;
                $deviceLogs->overload_status = $overload_staus;
                if ($deviceLogs->save()) {
                    return true;
                } else {
                    echo "<pre>";
                    print_r($deviceLogs->getErrors());
                    return false;
                }
                break;
            case "04":
                break;
        }
    }

}
