<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_device_junk".
 *
 * @property integer $id
 * @property integer $region_id
 * @property integer $device_id
 * @property string $device_data
 * @property string $created
 */
class DeviceJunk extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tbl_device_junk';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['region_id', 'device_id'], 'required'],
            [['id', 'region_id', 'device_id'], 'integer'],
            [['device_data'], 'string'],
            [['created'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'region_id' => 'Region ID',
            'device_id' => 'Device ID',
            'device_data' => 'Device Data',
            'created' => 'Created',
        ];
    }

}
