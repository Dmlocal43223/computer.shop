<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string $name Наименование
 * @property int $territory_id Территория
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Store[] $stores
 * @property Territory $territory
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'territory_id'], 'required'],
            [['territory_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['territory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Territory::class, 'targetAttribute' => ['territory_id' => 'id']],
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
            'territory_id' => 'Территория',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * Gets query for [[Stores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStores()
    {
        return $this->hasMany(Store::class, ['city_id' => 'id']);
    }

    /**
     * Gets query for [[Territory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTerritory()
    {
        return $this->hasOne(Territory::class, ['id' => 'territory_id']);
    }
}
