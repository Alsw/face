<?php

use yii\db\Migration;

class m170330_081034_alert_user_cloums extends Migration
{
    public function up()
    {
        $sql = "
            ALTER TABLE  `user` ADD  `sex` CHAR( 2 ) NOT NULL DEFAULT  '' AFTER  `username` ;
            ALTER TABLE  `user` ADD  `birthday` INT UNSIGNED NOT NULL DEFAULT  '0' AFTER  `sex` ;
            ALTER TABLE  `user` ADD  `phoneNumber` VARCHAR( 20 ) NOT NULL DEFAULT  '' AFTER  `birthday` ;
            ALTER TABLE  `user` ADD  `attentionCount` INT UNSIGNED NOT NULL DEFAULT  '0' AFTER  `phoneNumber` ;
            ALTER TABLE  `user` ADD  `introduce` TEXT NULL DEFAULT NULL AFTER  `attentionCount` ;
            ALTER TABLE  `user` ADD  `avatar` VARCHAR( 128 ) NOT NULL DEFAULT  '' AFTER  `username` ;
        ";
        $this->execute($sql);
    }

    public function down()
    {
        echo "m170330_081034_alert_user_cloums cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
