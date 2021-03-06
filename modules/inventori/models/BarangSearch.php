<?php

namespace backend\modules\inventori\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\inventori\models\Barang;

/**
 * BarangSearch represents the model behind the search form of `backend\modules\inventori\models\Barang`.
 */
class BarangSearch extends Barang
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'satuan_id', 'merk_id'], 'integer'],
            [['nama', 'kode', 'created_at', 'updated_at'], 'safe'],
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
        $query = Barang::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            // 'sort' => [
            //     'defaultOrder' => [
            //         'id' => SORT_ASC,
            //     ],
            // ],
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
            'satuan_id' => $this->satuan_id,
            'merk_id' => $this->merk_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
        ->andFilterWhere(['like', 'kode', $this->kode]);

        return $dataProvider;
    }
}
