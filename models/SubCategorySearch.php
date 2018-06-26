<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SubCategory;

/**
 * SubCategorySearch represents the model behind the search form of `app\models\SubCategory`.
 */
class SubCategorySearch extends SubCategory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sub_category_id'], 'integer'],
            [['sub_category_name', 'sub_category_url'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = SubCategory::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'sub_category_id' => $this->sub_category_id,
        ]);

        $query->andFilterWhere(['like', 'sub_category_name', $this->sub_category_name])
            ->andFilterWhere(['like', 'sub_category_url', $this->sub_category_url]);

        return $dataProvider;
    }
}
