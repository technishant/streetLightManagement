<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_region".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $postcode
 * @property string $created
 *
 * @property TblDeviceLogs[] $tblDeviceLogs
 * @property TblDeviceSetting[] $tblDeviceSettings
 * @property TblDevices[] $tblDevices
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created'], 'safe'],
            [['name', 'description', 'address', 'city', 'state', 'country', 'postcode'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
            'postcode' => 'Postcode',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblDeviceLogs()
    {
        return $this->hasMany(TblDeviceLogs::className(), ['region_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblDeviceSettings()
    {
        return $this->hasMany(TblDeviceSetting::className(), ['region_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblDevices()
    {
        return $this->hasMany(TblDevices::className(), ['region_id' => 'id']);
    }
}
