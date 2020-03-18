<?php

namespace backend\modules\inventori\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\inventori\models\BarangMasuk;

/**
 * BarangMasukSearch represents the model behind the search form of `backend\modules\inventori\models\BarangMasuk`.
 */
class BarangMasukSearch extends BarangMasuk
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'barang_id', 'qty', 'gudang_id'], 'integer'],
            [['harga_perolehan'], 'number'],
            [['deskripsi', 'nomor', 'tanggal', 'created_at', 'updated_at'], 'safe'],
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
        $query = BarangMasuk::find();

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
            'barang_id' => $this->barang_id,
            'qty' => $this->qty,
            'harga_perolehan' => $this->harga_perolehan,
            'gudang_id' => $this->gudang_id,
            'tanggal' => $this->tanggal,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'deskripsi', $this->deskripsi])
            ->andFilterWhere(['like', 'nomor', $this->nomor]);

        return $dataProvider;
    }
}
