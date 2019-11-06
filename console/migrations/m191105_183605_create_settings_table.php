<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%settings}}`.
 */
class m191105_183605_create_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),
            'convert_money_coefficient' => $this->float()->notNull()->defaultValue(1),
            'money_range_from' => $this->integer()->notNull()->defaultValue(1),
            'money_range_to' => $this->integer()->notNull()->defaultValue(1000),
            'bonus_range_from' => $this->integer()->notNull()->defaultValue(1),
            'bonus_range_to' => $this->integer()->notNull()->defaultValue(1000),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%settings}}');
    }
}
