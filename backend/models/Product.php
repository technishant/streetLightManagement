<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_product".
 *
 * @property integer $id
 * @property string $name
 * @property double $power
 * @property integer $light_source
 * @property string $warranty
 * @property double $input_voltage
 * @property double $load_capacity
 * @property double $high_cut
 * @property double $low_cut
 * @property string $case
 * @property string $body_color
 * @property string $ip_grade
 * @property string $created
 * @property string $quality_approved
 * @property string $place_of_origin
 * @property integer $created_by
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'power'], 'required'],
            [['power', 'load_capacity', 'high_cut', 'low_cut'], 'number'],
            [['light_source', 'created_by'], 'integer'],
            [['created'], 'safe'],
            [['name', 'quality_approved', 'place_of_origin'], 'string', 'max' => 255],
            [['warranty', 'case', 'body_color', 'ip_grade', 'input_voltage'], 'string', 'max' => 45]
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
            'power' => 'Power',
            'light_source' => 'Light Source',
            'warranty' => 'Warranty',
            'input_voltage' => 'Input Voltage',
            'load_capacity' => 'Load Capacity',
            'high_cut' => 'High Cut',
            'low_cut' => 'Low Cut',
            'case' => 'Case',
            'body_color' => 'Body Color',
            'ip_grade' => 'IP Grade',
            'created' => 'Created',
            'quality_approved' => 'Quality Approved',
            'place_of_origin' => 'Place Of Origin',
            'created_by' => 'Created By',
        ];
    }
}
