<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "device".
 *
 * @property int $id
 * @property int $price Цена
 * @property string $serial_number Серийный номер
 * @property int $device_model_id Модель
 * @property string $manufacturer_country Страна производитель
 * @property string $created_at
 * @property string $updated_at
 *
 * @property DeviceModel $deviceModel
 */
class Device extends ActiveRecord
{
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
            [['price', 'serial_number', 'device_model_id', 'manufacturer_country'], 'required'],
            [['price', 'device_model_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['serial_number', 'manufacturer_country'], 'string', 'max' => 255],
            [['serial_number'], 'unique'],
            [['device_model_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeviceModel::class, 'targetAttribute' => ['device_model_id' => 'id']],
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
            'serial_number' => 'Серийный номер',
            'device_model_id' => 'Модель',
            'manufacturer_country' => 'Страна производитель',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
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
}
