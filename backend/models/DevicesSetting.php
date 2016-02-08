<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_device_setting".
 *
 * @property integer $id
 * @property integer $region_id
 * @property integer $device_id
 * @property string $high_cut
 * @property string $low_cut
 * @property string $overload
 * @property integer $mode
 * @property string $time
 * @property string $date
 * @property string $created
 *
 * @property TblDevices $device
 * @property TblRegion $region
 */
class DevicesSetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_device_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id', 'device_id', 'high_cut', 'low_cut', 'overload', 'mode', 'time', 'date'], 'required'],
            [['region_id', 'device_id', 'mode'], 'integer'],
            [['time', 'date', 'created'], 'safe'],
            [['high_cut', 'low_cut', 'overload'], 'string', 'max' => 45]
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
            'high_cut' => 'High Cut',
            'low_cut' => 'Low Cut',
            'overload' => 'Overload',
            'mode' => 'Mode',
            'time' => 'Time',
            'date' => 'Date',
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
