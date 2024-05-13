<?php

use yii\db\Migration;

/**
 * Class m240504_101703_device_type
 */
class m240504_101703_device_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('device_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->unique()->comment('Наименование'),
            'image' => $this->string(255)->comment('Изображение'),
            'category_id' => $this->integer()->notNull()->comment('Категория'),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ]);

        $this->createIndex(
            'idx-device_type-category_id',
            'device_type',
            'category_id'
        );

        $this->addForeignKey(
            'fk-device_type-category_id',
            'device_type',
            'category_id',
            'device_category',
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
//        $this->dropForeignKey(
//            'fk-device_type-category_id',
//            'device_type'
//        );
//
//        $this->dropIndex(
//            'idx-device_type-category_id',
//            'device_type'
//        );

        $this->dropTable('device_type');
    }
}
