<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "device_model".
 *
 * @property int $id
 * @property string $name Наименование модели
 * @property string $description Описание
 * @property int $price Цена
 * @property int $device_type_id Тип устройства
 * @property int manufacturer_id Производитель
 * @property int|null $guarantee Гарантия
 * @property int|null $rating Рейтинг
 * @property string $created_at
 * @property string $updated_at
 *
 * @property DeviceType $deviceType
 * @property Device[] $devices
 */
class DeviceModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'device_model';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'price', 'device_type_id', 'manufacturer_id'], 'required'],
            [['price', 'device_type_id', 'guarantee', 'rating', 'manufacturer_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1020],
            ['rating', 'default', 'value' => 0],
            [['device_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeviceType::class, 'targetAttribute' => ['device_type_id' => 'id']],
            [['manufacturer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacturer::class, 'targetAttribute' => ['manufacturer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'description' => 'Описание',
            'price' => 'Цена',
            'device_type_id' => 'Тип устройства',
            'manufacturer_id' => 'Производитель',
            'guarantee' => 'Гарантия',
            'rating' => 'Рейтинг',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * Gets query for [[DeviceType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceType()
    {
        return $this->hasOne(DeviceType::class, ['id' => 'device_type_id']);
    }

    /**
     * Gets query for [[Devices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDevices()
    {
        return $this->hasMany(Device::class, ['device_model_id' => 'id']);
    }
}
