<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "store".
 *
 * @property int $id
 * @property string $name Наименование
 * @property string $type
 * @property int $is_deleted
 * @property string $address Адрес
 * @property int $territory_id Территория
 * @property int $city_id Город
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Territory $territory
 * @property Territory $city
 */
class Store extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'store';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'type', 'address', 'territory_id', 'city_id'], 'required'],
            [['type'], 'string'],
            [['is_deleted', 'territory_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'address'], 'string', 'max' => 255],
            [['territory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Territory::class, 'targetAttribute' => ['territory_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
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
            'type' => 'Тип',
            'is_deleted' => 'Удален',
            'address' => 'Адрес',
            'territory_id' => 'Территория',
            'city_id' => 'Город',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * Gets query for [[Territory]].
     *
     * @return ActiveQuery
     */
    public function getTerritory(): ActiveQuery
    {
        return $this->hasOne(Territory::class, ['id' => 'territory_id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return ActiveQuery
     */
    public function getCity(): ActiveQuery
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }
}
