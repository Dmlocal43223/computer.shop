<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "device_type".
 *
 * @property int $id
 * @property string $name Наименование типа
 * @property string $created_at
 * @property string $updated_at
 *
 * @property DeviceModel[] $deviceModels
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
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
}
