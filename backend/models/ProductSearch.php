<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Product;

/**
 * ProductSearch represents the model behind the search form about `backend\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'light_source', 'created_by'], 'integer'],
            [['name', 'warranty', 'case', 'body_color', 'ip_grade', 'created', 'quality_approved', 'place_of_origin'], 'safe'],
            [['power', 'input_voltage', 'load_capacity', 'high_cut', 'low_cut'], 'number'],
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
        $query = Product::find();

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
            'power' => $this->power,
            'light_source' => $this->light_source,
            'input_voltage' => $this->input_voltage,
            'load_capacity' => $this->load_capacity,
            'high_cut' => $this->high_cut,
            'low_cut' => $this->low_cut,
            'created' => $this->created,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'warranty', $this->warranty])
            ->andFilterWhere(['like', 'case', $this->case])
            ->andFilterWhere(['like', 'body_color', $this->body_color])
            ->andFilterWhere(['like', 'ip_grade', $this->ip_grade])
            ->andFilterWhere(['like', 'quality_approved', $this->quality_approved])
            ->andFilterWhere(['like', 'place_of_origin', $this->place_of_origin]);

        return $dataProvider;
    }
}
