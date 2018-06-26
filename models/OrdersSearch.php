<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Orders;

/**
 * OrdersSearch represents the model behind the search form of `app\models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'order_date', 'order_name', 'order_email', 'order_province', 'order_city', 'order_sub', 'order_address', 'order_courier', 'order_service', 'order_notes', 'order_user', 'voucher_code', 'voucher_name', 'order_payment'], 'safe'],
            [['order_weight'], 'number'],
            [['order_cost_delivery', 'voucher_value', 'order_total'], 'integer'],
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
        $query = Orders::find();

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
            'order_date' => $this->order_date,
            'order_weight' => $this->order_weight,
            'order_cost_delivery' => $this->order_cost_delivery,
            'voucher_value' => $this->voucher_value,
            'order_total' => $this->order_total,
        ]);

        $query->andFilterWhere(['like', 'order_id', $this->order_id])
            ->andFilterWhere(['like', 'order_name', $this->order_name])
            ->andFilterWhere(['like', 'order_email', $this->order_email])
            ->andFilterWhere(['like', 'order_province', $this->order_province])
            ->andFilterWhere(['like', 'order_city', $this->order_city])
            ->andFilterWhere(['like', 'order_sub', $this->order_sub])
            ->andFilterWhere(['like', 'order_address', $this->order_address])
            ->andFilterWhere(['like', 'order_courier', $this->order_courier])
            ->andFilterWhere(['like', 'order_service', $this->order_service])
            ->andFilterWhere(['like', 'order_notes', $this->order_notes])
            ->andFilterWhere(['like', 'order_user', $this->order_user])
            ->andFilterWhere(['like', 'voucher_code', $this->voucher_code])
            ->andFilterWhere(['like', 'voucher_name', $this->voucher_name])
            ->andFilterWhere(['like', 'order_payment', $this->order_payment]);

        return $dataProvider;
    }
}
