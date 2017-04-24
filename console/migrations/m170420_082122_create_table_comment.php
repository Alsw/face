<?php

use yii\db\Migration;

class m170420_082122_create_table_comment extends Migration
{
    public function up()
    {
         $sql = "
            CREATE TABLE  IF NOT EXISTS `comment` (
                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                 `objectType` varchar(20) NOT NULL,
                 `objectId` int(10) unsigned NOT NULL,
                 `userId` int(10) unsigned NOT NULL DEFAULT '0',
                 `content` text NOT NULL,
                 `createdTime` int(10) unsigned NOT NULL,
                 PRIMARY KEY (`id`),
                 UNIQUE KEY `id` (`id`)
                ) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8
                ";

        $this->execute($sql);
    }

    public function down()
    {
        echo "m170420_082122_create_table_comment cannot be reverted.\n";

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
