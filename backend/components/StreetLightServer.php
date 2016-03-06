<?php

namespace backend\components;

include_once 'Connection.php';
include_once 'Server.php';
include_once 'Socket.php';
use backend\models\Devices;
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
        $this->server = new Server('52.89.229.139', 8000, false);
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
        if(!empty($device)) {
            $device->status = 0;
            $device->save();
        }
        

        if (isset($this->connections[$connection_id])) {
            unset($this->connections[$connection_id]);
        }
    }

    /* Fired when data received */

    public function onDataReceive($connection_id, $data) {
        
        echo "\nData received from $connection_id :".$data;
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
        if(strlen($data) == 14) {
            echo "\nGood Data From $connection_id :".$data;
        } else {
            echo "\nBad Data From $connection_id :".$data;
            $data = 404;
            $this->sendDataToConnection($connection_id, "BAD DATA", $data);
        }
    }

}
