<?php

namespace backend\modules\inventori\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "detail_pembelian".
 *
 * @property int $id
 * @property int|null $qty
 * @property int $pembelian_id
 * @property int $barang_id
 * @property float|null $harga
 * @property string|null $deskripsi
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Barang $barang
 * @property Pembelian $pembelian
 */
class DetailPembelian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_pembelian';
    }

    public function behaviors()
    {
    return [
        'timestamp' => [
            'class' => TimestampBehavior::className(),
            'createdAtAttribute' => 'created_at',
            'updatedAtAttribute' => 'updated_at',
            'value' => new Expression('NOW()'),
        ],
        'blameable' => [
            'class' => BlameableBehavior::className(),
            'createdByAttribute' => 'created_by',
            'updatedByAttribute' => 'updated_by',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['qty', 'pembelian_id', 'barang_id'], 'integer'],
     //       [['pembelian_id', 'barang_id'], 'required'],
            [['harga'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['deskripsi'], 'string', 'max' => 45],
            [['barang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Barang::className(), 'targetAttribute' => ['barang_id' => 'id']],
            [['pembelian_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pembelian::className(), 'targetAttribute' => ['pembelian_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'qty' => 'Qty',
            'pembelian_id' => 'Pembelian',
            'barang_id' => 'Barang',
            'harga' => 'Harga',
            'deskripsi' => 'Deskripsi',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBarang()
    {
        return $this->hasOne(Barang::className(), ['id' => 'barang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPembelian()
    {
        return $this->hasOne(Pembelian::className(), ['id' => 'pembelian_id']);
    }
}
