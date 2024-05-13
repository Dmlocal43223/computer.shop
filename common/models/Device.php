<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "device".
 *
 * @property int $id
 * @property int $price Цена
 * @property string $status Статус
 * @property int $store_id Склад
 * @property string $serial_number Серийный номер
 * @property int $device_model_id Модель
 * @property int $manufacturer_country_id Страна производитель
 * @property string $created_at
 * @property string $updated_at
 *
 * @property DeviceModel $deviceModel
 * @property Country $country
 * @property Store $store
 */
class Device extends ActiveRecord
{
    public const STATUS_SHOP = 'shop';
    public const STATUS_STORE = 'store';
    public const STATUS_SALES = 'sales';
    public const STATUS_REPAIR = 'repair';
    public const STATUS_DEFECT = 'defect';

    public const STATUS_SHIPPING = 'shipping';
    public const STATUS_DELETED = 'deleted';


    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'device';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['price', 'serial_number', 'device_model_id', 'manufacturer_country_id', 'status'], 'required'],
            [['price', 'device_model_id', 'manufacturer_country_id', 'store_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['serial_number'], 'string', 'max' => 255],
            [['serial_number'], 'unique'],
            [['device_model_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeviceModel::class, 'targetAttribute' => ['device_model_id' => 'id']],
            [['manufacturer_country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::class, 'targetAttribute' => ['manufacturer_country_id' => 'id']],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Store::class, 'targetAttribute' => ['store_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'price' => 'Цена',
            'status' => 'Статус',
            'store_id' => 'Склад',
            'serial_number' => 'Серийный номер',
            'device_model_id' => 'Модель',
            'manufacturer_country_id' => 'Страна производитель',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * Gets query for [[DeviceModel]].
     *
     * @return ActiveQuery
     */
    public function getDeviceModel(): ActiveQuery
    {
        return $this->hasOne(DeviceModel::class, ['id' => 'device_model_id']);
    }
    public function getCountry(): ActiveQuery
    {
        return $this->hasOne(Country::class, ['id' => 'manufacturer_country_id']);
    }

    public function getStore(): ActiveQuery
    {
        return $this->hasOne(Store::class, ['id' => 'store_id']);
    }
}
