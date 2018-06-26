<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Customer;

/**
 * CustomerSearch represents the model behind the search form of `app\models\Customer`.
 */
class CustomerSearch extends Customer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_customer', 'nama', 'alamat', 'kode_pos', 'telp', 'fax', 'email', 'website', 'member_of', 'nama_pemilik', 'rating', 'id_propinsi', 'id_kota', 'id_kategori_customer', 'id_tipe_customer', 'id_campaign', 'id_jenis_industri', 'catatan', 'warning_sales', 'warning_kirim', 'warning_tagih', 'id_sales', 'acc_norek', 'acc_bank', 'acc_pemilik', 'siup_no', 'tdp_no', 'npwp', 'ktp_no', 'created_by', 'created_on', 'modified_by', 'modified_on', 'top'], 'safe'],
            [['pendapatan', 'jumlah_karyawan', 'plafon'], 'integer'],
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
        $query = Customer::find();

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
            'pendapatan' => $this->pendapatan,
            'jumlah_karyawan' => $this->jumlah_karyawan,
            'created_on' => $this->created_on,
            'modified_on' => $this->modified_on,
            'plafon' => $this->plafon,
        ]);

        $query->andFilterWhere(['like', 'id_customer', $this->id_customer])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'kode_pos', $this->kode_pos])
            ->andFilterWhere(['like', 'telp', $this->telp])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'member_of', $this->member_of])
            ->andFilterWhere(['like', 'nama_pemilik', $this->nama_pemilik])
            ->andFilterWhere(['like', 'rating', $this->rating])
            ->andFilterWhere(['like', 'id_propinsi', $this->id_propinsi])
            ->andFilterWhere(['like', 'id_kota', $this->id_kota])
            ->andFilterWhere(['like', 'id_kategori_customer', $this->id_kategori_customer])
            ->andFilterWhere(['like', 'id_tipe_customer', $this->id_tipe_customer])
            ->andFilterWhere(['like', 'id_campaign', $this->id_campaign])
            ->andFilterWhere(['like', 'id_jenis_industri', $this->id_jenis_industri])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
            ->andFilterWhere(['like', 'warning_sales', $this->warning_sales])
            ->andFilterWhere(['like', 'warning_kirim', $this->warning_kirim])
            ->andFilterWhere(['like', 'warning_tagih', $this->warning_tagih])
            ->andFilterWhere(['like', 'id_sales', $this->id_sales])
            ->andFilterWhere(['like', 'acc_norek', $this->acc_norek])
            ->andFilterWhere(['like', 'acc_bank', $this->acc_bank])
            ->andFilterWhere(['like', 'acc_pemilik', $this->acc_pemilik])
            ->andFilterWhere(['like', 'siup_no', $this->siup_no])
            ->andFilterWhere(['like', 'tdp_no', $this->tdp_no])
            ->andFilterWhere(['like', 'npwp', $this->npwp])
            ->andFilterWhere(['like', 'ktp_no', $this->ktp_no])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by])
            ->andFilterWhere(['like', 'top', $this->top]);

        return $dataProvider;
    }
}
