<?php

namespace backend\modules\inventori\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "barang".
 *
 * @property int $id
 * @property int $satuan_id
 * @property int $merk_id
 * @property string|null $nama
 * @property string|null $kode
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Merk $merk
 * @property Satuan $satuan
 * @property BarangKeluar[] $barangKeluars
 * @property BarangMasuk[] $barangMasuks
 * @property DetailPembelian[] $detailPembelians
 */
class Barang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barang';
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
            [['satuan_id', 'merk_id'], 'required'],
            [['satuan_id', 'merk_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nama'], 'string', 'max' => 45],
            [['kode'], 'string', 'max' => 4],
            [['merk_id'], 'exist', 'skipOnError' => true, 'targetClass' => Merk::className(), 'targetAttribute' => ['merk_id' => 'id']],
            [['satuan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Satuan::className(), 'targetAttribute' => ['satuan_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'satuan_id' => 'Satuan',
            'merk_id' => 'Merk ID',
            'nama' => 'Nama',
            'kode' => 'Kode',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMerk()
    {
        return $this->hasOne(Merk::className(), ['id' => 'merk_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSatuan()
    {
        return $this->hasOne(Satuan::className(), ['id' => 'satuan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBarangKeluars()
    {
        return $this->hasMany(BarangKeluar::className(), ['barang_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBarangMasuks()
    {
        return $this->hasMany(BarangMasuk::className(), ['barang_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPembelians()
    {
        return $this->hasMany(DetailPembelian::className(), ['barang_id' => 'id']);
    }
}
