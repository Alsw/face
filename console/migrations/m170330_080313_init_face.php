<?php

use yii\db\Migration;

class m170330_080313_init_face extends Migration
{
    public function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS `article_category` (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL COMMENT '栏目名称',
              `code` varchar(64) NOT NULL COMMENT 'URL目录名称',
              `weight` int(11) NOT NULL DEFAULT '0',
              `publishArticle` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否允许发布文章',
              `published` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否启用（1：启用 0：停用)',
              `parentId` int(10) unsigned NOT NULL DEFAULT '0',
              `createdTime` int(10) unsigned NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`),
              UNIQUE KEY `code` (`code`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
            CREATE TABLE IF NOT EXISTS `article_like` (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '系统id',
              `articleId` int(10) unsigned NOT NULL COMMENT '资讯id',
              `userId` int(10) unsigned NOT NULL COMMENT '用户id',
              `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点赞时间',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='资讯点赞表' AUTO_INCREMENT=1 ;
            CREATE TABLE IF NOT EXISTS `attention` (
              `id` int(10) unsigned NOT NULL,
              `userId` int(10) unsigned NOT NULL,
              `attentionedId` int(10) unsigned NOT NULL,
              `attentionTime` int(10) unsigned NOT NULL,
              `status` tinyint(4) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
            CREATE TABLE IF NOT EXISTS `comment` (
              `id` int(10) unsigned NOT NULL,
              `objectType` tinyint(4) NOT NULL,
              `objectId` int(10) unsigned NOT NULL,
              `userId` int(10) unsigned NOT NULL DEFAULT '0',
              `content` text NOT NULL,
              `createdTime` int(10) unsigned NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `id` (`id`),
              UNIQUE KEY `objectType` (`objectType`),
              UNIQUE KEY `objectId` (`objectId`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
            CREATE TABLE IF NOT EXISTS `session` (
              `id` int(10) unsigned NOT NULL,
              `name` varchar(50) NOT NULL,
              `profile` varchar(1024) NOT NULL,
              `count` int(255) unsigned NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
            CREATE TABLE IF NOT EXISTS `thread` (
              `id` int(10) unsigned NOT NULL,
              `sessionId` int(10) unsigned NOT NULL,
              `userId` int(10) unsigned NOT NULL,
              `title` varchar(50) NOT NULL,
              `content` text NOT NULL,
              `createTime` int(10) unsigned NOT NULL,
              `status` int(10) unsigned NOT NULL,
              `commetCount` int(10) unsigned NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
        ";
        $this->execute($sql);
    }

    public function down()
    {
        echo "m170330_080313_init_face cannot be reverted.\n";

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
