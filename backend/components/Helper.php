<?php

namespace backend\components;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Helper
 *
 * @author Nishant Goel
 */
class Helper {

    public static function voltageStatus($status) {
        $response = array(
            0 => "High Voltage",
            1 => "Low Voltage",
            2 => "Normal Voltage"
        );
        if (in_array($status, array_keys($response))) {
            return $response[$status];
        } else {
            return $status;
        }
    }

    public static function lightStatus($status) {
        $response = array(
            0 => "Off",
            1 => "On",
        );
        if (in_array($status, array_keys($response))) {
            return $response[$status];
        } else {
            return $status;
        }
    }

    public static function overloadStatus($status) {
        $response = array(
            0 => "No overload",
            1 => "Overload alert",
        );
        if (in_array($status, array_keys($response))) {
            return $response[$status];
        } else {
            return $status;
        }
    }

}
