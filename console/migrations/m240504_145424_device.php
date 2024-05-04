<?php

use yii\db\Migration;

/**
 * Class m240504_145424_device
 */
class m240504_145424_device extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('device', [
            'id' => $this->primaryKey(),
            'price' => $this->integer()->notNull()->comment('Цена'),
            'serial_number' => $this->string(255)->notNull()->unique()->comment('Серийный номер'),
            'device_model_id' => $this->integer()->notNull()->comment('Модель'),
            'manufacturer_country' => $this->string(255)->notNull()->comment('Страна производитель'),
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

        $this->dropTable('device');
    }
}
