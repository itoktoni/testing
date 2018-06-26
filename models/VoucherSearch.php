<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Voucher;

/**
 * VoucherSearch represents the model behind the search form of `app\models\Voucher`.
 */
class VoucherSearch extends Voucher
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['voucher_id'], 'integer'],
            [['voucher_code', 'voucher_name', 'voucher_description', 'voucher_operan', 'voucher_validation'], 'safe'],
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
        $query = Voucher::find();

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
            'voucher_id' => $this->voucher_id,
        ]);

        $query->andFilterWhere(['like', 'voucher_code', $this->voucher_code])
            ->andFilterWhere(['like', 'voucher_name', $this->voucher_name])
            ->andFilterWhere(['like', 'voucher_description', $this->voucher_description])
            ->andFilterWhere(['like', 'voucher_operan', $this->voucher_operan])
            ->andFilterWhere(['like', 'voucher_validation', $this->voucher_validation]);

        return $dataProvider;
    }
}
