<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_devices".
 *
 * @property integer $id
 * @property integer $region_id
 * @property string $controller_id
 * @property integer $type
 * @property string $latitude
 * @property string $longitude
 * @property string $sim_number
 * @property string $imei_number
 * @property string $contact_1_name
 * @property string $contact__1_phone
 * @property string $contact_1_email
 * @property string $contact_2_name
 * @property string $contact_2_phone
 * @property string $contact_2_email
 * @property integer $status
 * @property string $server_id
 * @property string $created
 *
 * @property TblDeviceLogs[] $tblDeviceLogs
 * @property TblDeviceSetting[] $tblDeviceSettings
 * @property TblRegion $region
 */
class Devices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_devices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id', 'controller_id', 'sim_number', 'imei_number'], 'required'],
            [['region_id', 'type', 'status'], 'integer'],
            [['created'], 'safe'],
            [['latitude', 'longitude', 'sim_number', 'imei_number', 'contact_1_name', 'contact__1_phone', 'contact_1_email', 'contact_2_name', 'contact_2_phone', 'contact_2_email'], 'string', 'max' => 255],
            [['server_id'], 'string', 'max' => 45],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
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
            'controller_id' => 'Controller ID',
            'type' => 'Type',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'sim_number' => 'SIM Number',
            'imei_number' => 'IMEI Number',
            'contact_1_name' => 'Contact 1 Name',
            'contact__1_phone' => 'Contact  1 Phone',
            'contact_1_email' => 'Contact 1 Email',
            'contact_2_name' => 'Contact 2 Name',
            'contact_2_phone' => 'Contact 2 Phone',
            'contact_2_email' => 'Contact 2 Email',
            'status' => 'Status',
            'server_id' => 'Server ID',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblDeviceLogs()
    {
        return $this->hasMany(TblDeviceLogs::className(), ['device_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblDeviceSettings()
    {
        return $this->hasMany(TblDeviceSetting::className(), ['device_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(TblRegion::className(), ['id' => 'region_id']);
    }
}
