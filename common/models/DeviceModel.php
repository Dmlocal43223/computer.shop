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
            [['name', 'description', 'price', 'device_type_id'], 'required'],
            [['price', 'device_type_id', 'guarantee', 'rating'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1020],
            [['device_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeviceType::class, 'targetAttribute' => ['device_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'device_type_id' => 'Device Type ID',
            'guarantee' => 'Guarantee',
            'rating' => 'Rating',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
