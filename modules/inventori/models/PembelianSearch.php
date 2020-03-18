<?php

namespace backend\modules\inventori\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\inventori\models\Pembelian;

/**
 * PembelianSearch represents the model behind the search form of `backend\modules\inventori\models\Pembelian`.
 */
class PembelianSearch extends Pembelian
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'vendor_id'], 'integer'],
            [['kode', 'tanggal', 'created_at', 'updated_at'], 'safe'],
            [['total'], 'number'],
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
        $query = Pembelian::find();
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
            'tanggal' => $this->tanggal,
            'total' => $this->total,
            'vendor_id' => $this->vendor_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'kode', $this->kode]);

        return $dataProvider;
    }
}
