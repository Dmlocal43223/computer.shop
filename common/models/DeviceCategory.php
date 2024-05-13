<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "device_category".
 *
 * @property int $id
 * @property string $name Наименование
 * @property string|null $image Изображение
 * @property string $created_at
 * @property string $updated_at
 *
 * @property DeviceType[] $deviceTypes
 */
class DeviceCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'device_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'image'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
            'image' => 'Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[DeviceTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceTypes()
    {
        return $this->hasMany(DeviceType::class, ['category_id' => 'id']);
    }
}
