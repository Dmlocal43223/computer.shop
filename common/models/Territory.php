<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "territory".
 *
 * @property int $id
 * @property string $name Наименование
 * @property string $district
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Store[] $stores
 */
class Territory extends ActiveRecord
{
    public const CENTRAL = 'central';
    public const SOUTHERN = 'southern';
    public const NORTHWESTERN = 'northwestern';
    public const FAR_EASTERN = 'far_eastern';
    public const SIBERIAN = 'siberian';
    public const URAL = 'ural';
    public const VOLGA = 'volga';
    public const NORTH_CAUCASIAN = 'north_caucasian';

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'territory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'district'], 'required'],
            [['district'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['name'], 'trim'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'district' => 'Округ',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * Gets query for [[Stores]].
     *
     * @return ActiveQuery
     */
    public function getStores(): ActiveQuery
    {
        return $this->hasMany(Store::class, ['territory_id' => 'id']);
    }
}
