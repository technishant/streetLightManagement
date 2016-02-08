<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DevicesSetting;

/**
 * DevicesSettingSearch represents the model behind the search form about `backend\models\DevicesSetting`.
 */
class DevicesSettingSearch extends DevicesSetting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'region_id', 'device_id', 'mode'], 'integer'],
            [['high_cut', 'low_cut', 'overload', 'time', 'date', 'created'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = DevicesSetting::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'region_id' => $this->region_id,
            'device_id' => $this->device_id,
            'mode' => $this->mode,
            'time' => $this->time,
            'date' => $this->date,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'high_cut', $this->high_cut])
            ->andFilterWhere(['like', 'low_cut', $this->low_cut])
            ->andFilterWhere(['like', 'overload', $this->overload]);

        return $dataProvider;
    }
}
