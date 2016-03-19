<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_device_logs".
 *
 * @property integer $id
 * @property integer $region_id
 * @property integer $device_id
 * @property double $current_voltage
 * @property double $current_load
 * @property integer $voltage_status
 * @property integer $power_status
 * @property integer $controller_data_status
 * @property integer $light_status
 * @property integer $overload_status
 * @property string $created
 *
 * @property TblDevices $device
 * @property TblRegion $region
 */
class DeviceLogs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_device_logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id', 'device_id'], 'required'],
            [['region_id', 'device_id', 'voltage_status', 'power_status', 'controller_data_status', 'light_status', 'overload_status'], 'integer'],
            [['current_voltage', 'current_load'], 'number'],
            [['created'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region_id' => 'Region ID',
            'device_id' => 'Device ID',
            'current_voltage' => 'Current Voltage',
            'current_load' => 'Current Load',
            'voltage_status' => 'Voltage Status',
            'power_status' => 'Power Status',
            'controller_data_status' => 'Controller Data Status',
            'light_status' => 'Light Status',
            'overload_status' => 'Overload Status',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevice()
    {
        return $this->hasOne(TblDevices::className(), ['id' => 'device_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(TblRegion::className(), ['id' => 'region_id']);
    }
}
