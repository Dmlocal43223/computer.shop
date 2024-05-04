<?php

use yii\db\Migration;

/**
 * Class m240504_120144_device_model
 */
class m240504_120144_device_model extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('device_model', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->comment('Наименование'),
            'description' => $this->string(1020)->notNull()->comment('Описание'),
            'price' => $this->integer()->notNull()->comment('Цена'),
            'device_type_id' => $this->integer()->notNull()->comment('Тип устройства'),
            'guarantee' => $this->integer()->defaultValue(0)->comment('Гарантия'),
            'rating' => $this->integer()->defaultValue(0)->comment('Рейтинг'),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ]);

        $this->createIndex(
            'idx-device_model-device_type_id',
            'device_model',
            'device_type_id'
        );

        $this->addForeignKey(
            'fk-device_model-device_type_id',
            'device_model',
            'device_type_id',
            'device_type',
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
            'fk-device_model-device_type_id',
            'device_model'
        );

        $this->dropIndex(
            'idx-device_model-device_type_id',
            'device_model'
        );

        $this->dropTable('device_model');
    }
}
