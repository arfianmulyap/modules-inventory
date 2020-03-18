<?php

namespace backend\modules\inventori\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "pembelian".
 *
 * @property int $id
 * @property string|null $kode
 * @property string|null $tanggal
 * @property float|null $total
 * @property int $vendor_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property DetailPembelian[] $detailPembelians
 * @property Vendor $vendor
 */
class Pembelian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pembelian';
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
//            [['id', 'vendor_id'], 'required'],
            [['id', 'vendor_id'], 'integer'],
            [['tanggal', 'created_at', 'updated_at'], 'safe'],
            [['total'], 'number'],
            [['kode'], 'string', 'max' => 10],
            [['kode'], 'unique'],
            [['id'], 'unique'],
            [['vendor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vendor::className(), 'targetAttribute' => ['vendor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'tanggal' => 'Tanggal',
            'total' => 'Total',
            'vendor_id' => 'Vendor',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPembelians()
    {
        return $this->hasMany(DetailPembelian::className(), ['pembelian_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendor()
    {
        return $this->hasOne(Vendor::className(), ['id' => 'vendor_id']);
    }
}
