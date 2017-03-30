<?php

use yii\db\Migration;

class m170330_083623_create_table_user_album extends Migration
{
    public function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS `user_album` (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `userId` int(10) unsigned NOT NULL DEFAULT '0',
              `imgPath` varchar(128) NOT NULL DEFAULT '',
              `createdTime` int(10) unsigned NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
        ";
        $this->execute($sql);
    }

    public function down()
    {
        echo "m170330_083623_create_table_user_album cannot be reverted.\n";

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
