<?php

namespace backend\modules\inventori\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "barang_keluar".
 *
 * @property int $id
 * @property int|null $qty
 * @property string|null $tanggal
 * @property int $barang_id
 * @property int $divisi_id
 * @property int $gudang_id
 * @property string|null $nomor
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Barang $barang
 * @property Divisi $divisi
 * @property Gudang $gudang
 */
class BarangKeluar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barang_keluar';
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
            [['qty', 'barang_id', 'divisi_id', 'gudang_id'], 'integer'],
            [['tanggal', 'created_at', 'updated_at'], 'safe'],
            [['barang_id', 'divisi_id', 'gudang_id'], 'required'],
            [['nomor'], 'string', 'max' => 10],
            [['barang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Barang::className(), 'targetAttribute' => ['barang_id' => 'id']],
            [['divisi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Divisi::className(), 'targetAttribute' => ['divisi_id' => 'id']],
            [['gudang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gudang::className(), 'targetAttribute' => ['gudang_id' => 'id']],
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
            'tanggal' => 'Tanggal',
            'barang_id' => 'Barang',
            'divisi_id' => 'Divisi',
            'gudang_id' => 'Gudang',
            'nomor' => 'Nomor',
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
    public function getDivisi()
    {
        return $this->hasOne(Divisi::className(), ['id' => 'divisi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGudang()
    {
        return $this->hasOne(Gudang::className(), ['id' => 'gudang_id']);
    }
}
