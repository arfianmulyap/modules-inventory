<?php

namespace backend\modules\inventori\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\inventori\models\DetailPembelian;

/**
 * DetailPembelianSearch represents the model behind the search form of `backend\modules\inventori\models\DetailPembelian`.
 */
class DetailPembelianSearch extends DetailPembelian
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'qty', 'pembelian_id', 'barang_id'], 'integer'],
            [['harga'], 'number'],
            [['deskripsi', 'created_at', 'updated_at'], 'safe'],
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
        $query = DetailPembelian::find();

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
            'pembelian_id' => $this->pembelian_id,
            'barang_id' => $this->barang_id,
            'harga' => $this->harga,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'deskripsi', $this->deskripsi]);

        return $dataProvider;
    }
}
