<?php

namespace backend\modules\inventori\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "vendor".
 *
 * @property int $id
 * @property string|null $kode
 * @property string|null $nama
 * @property string|null $kontak
 * @property string|null $alamat
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Pembelian[] $pembelians
 */
class Vendor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor';
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
            [['created_at', 'updated_at'], 'safe'],
            [['kode'], 'string', 'max' => 10],
            [['nama', 'alamat'], 'string', 'max' => 45],
            [['kontak'], 'string', 'max' => 30],
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
            'nama' => 'Nama',
            'kontak' => 'Kontak',
            'alamat' => 'Alamat',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPembelians()
    {
        return $this->hasMany(Pembelian::className(), ['vendor_id' => 'id']);
    }
}
