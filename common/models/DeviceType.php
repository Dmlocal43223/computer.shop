<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "device_type".
 *
 * @property int $id
 * @property string $name Наименование типа
 * @property string $category_id Категория
 * @property string $created_at
 * @property string $updated_at
 *
 * @property DeviceModel[] $deviceModels
 * @property DeviceCategory $category
 */
class DeviceType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'device_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['category_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeviceCategory::class, 'targetAttribute' => ['category_id' => 'id']],
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
            'category_id' => 'Категория',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * Gets query for [[DeviceModels]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceModels()
    {
        return $this->hasMany(DeviceModel::class, ['device_type_id' => 'id']);
    }

    public function getDeviceCategory()
    {
        return $this->hasMany(DeviceCategory::class, ['category_id' => 'id']);
    }
}
