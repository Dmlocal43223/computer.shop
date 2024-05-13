<?php

use yii\db\Migration;

/**
 * Class m240504_195424_device
 */
class m240504_195424_device extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('device', [
            'id' => $this->primaryKey(),
            'status' => "ENUM('shop', 'store', 'sales', 'repair', 'defect', 'shipping', 'deleted') NOT NULL",
            'image' => $this->string(255)->comment('Изображение'),
            'store_id' => $this->integer()->comment('Склад'),
            'serial_number' => $this->string(255)->notNull()->unique()->comment('Серийный номер'),
            'device_model_id' => $this->integer()->notNull()->comment('Модель'),
            'price' => $this->integer()->notNull()->comment('Цена'),
            'manufacturer_country_id' => $this->integer()->notNull()->comment('Страна производитель'),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ]);

        $this->createIndex(
            'idx-device-device_model_id',
            'device',
            'device_model_id'
        );

        $this->addForeignKey(
            'fk-device-device_model_id',
            'device',
            'device_model_id',
            'device_model',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->createIndex(
            'idx-device-store_id',
            'device',
            'store_id'
        );

        $this->addForeignKey(
            'fk-device-store_id',
            'device',
            'store_id',
            'store',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->createIndex(
            'idx-device-manufacturer_country_id',
            'device',
            'manufacturer_country_id'
        );

        $this->addForeignKey(
            'fk-device-manufacturer_country_id',
            'device',
            'manufacturer_country_id',
            'country',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-device-device_model_id',
            'device'
        );

        $this->dropIndex(
            'idx-device-device_model_id',
            'device'
        );

        $this->dropForeignKey(
            'fk-device-store_id',
            'device'
        );

        $this->dropIndex(
            'idx-device-store_id',
            'device'
        );

//        $this->dropForeignKey(
//            'fk-device-manufacturer_country_id',
//            'device'
//        );
//
//        $this->dropIndex(
//            'idx-device-manufacturer_country_id',
//            'device'
//        );

        $this->dropTable('device');
    }
}
