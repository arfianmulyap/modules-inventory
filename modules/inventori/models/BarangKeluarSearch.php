<?php

namespace backend\modules\inventori\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\inventori\models\BarangKeluar;

/**
 * BarangKeluarSearch represents the model behind the search form of `backend\modules\inventori\models\BarangKeluar`.
 */
class BarangKeluarSearch extends BarangKeluar
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'qty', 'barang_id', 'divisi_id', 'gudang_id'], 'integer'],
            [['tanggal', 'nomor', 'created_at', 'updated_at'], 'safe'],
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
        $query = BarangKeluar::find();

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
            'id' => $this->id,
            'qty' => $this->qty,
            'tanggal' => $this->tanggal,
            'barang_id' => $this->barang_id,
            'divisi_id' => $this->divisi_id,
            'gudang_id' => $this->gudang_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nomor', $this->nomor]);

        return $dataProvider;
    }
}
