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
            'key'=> $this->string(255)->notNull(),
            'value'=> $this->string(255)->notNull(),
        ]);


        Yii::$app->db->createCommand()->batchInsert('{{%settings}}', ['key', 'value'],
            [
                ['convert_money_coefficient', "1",],
                ['money_range_from', "1"],
                ['money_range_to', "1000"],
                ['bonus_range_from', "1"],
                ['bonus_range_to', "1000"],
            ])->
        execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%settings}}');
    }
}
