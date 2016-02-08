<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Devices;

/**
 * DevicesSearch represents the model behind the search form about `backend\models\Devices`.
 */
class DevicesSearch extends Devices
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'region_id', 'controller_id', 'type'], 'integer'],
            [['latitude', 'longitude', 'sim_number', 'imei_number', 'contact_1_name', 'contact__1_phone', 'contact_1_email', 'contact_2_name', 'contact_2_phone', 'contact_2_email', 'created'], 'safe'],
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
        $query = Devices::find();

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
            'controller_id' => $this->controller_id,
            'type' => $this->type,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'latitude', $this->latitude])
            ->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['like', 'sim_number', $this->sim_number])
            ->andFilterWhere(['like', 'imei_number', $this->imei_number])
            ->andFilterWhere(['like', 'contact_1_name', $this->contact_1_name])
            ->andFilterWhere(['like', 'contact__1_phone', $this->contact__1_phone])
            ->andFilterWhere(['like', 'contact_1_email', $this->contact_1_email])
            ->andFilterWhere(['like', 'contact_2_name', $this->contact_2_name])
            ->andFilterWhere(['like', 'contact_2_phone', $this->contact_2_phone])
            ->andFilterWhere(['like', 'contact_2_email', $this->contact_2_email]);

        return $dataProvider;
    }
}
