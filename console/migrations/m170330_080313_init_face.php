<?php

use yii\db\Migration;

class m170330_080313_init_face extends Migration
{
    public function up()
    {
        $sql = "
            CREATE TABLE `article` (
             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章ID',
             `title` varchar(255) NOT NULL COMMENT '文章标题',
             `categoryId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '栏目',
             `tagIds` varchar(255) DEFAULT NULL COMMENT 'tag标签',
             `source` varchar(1024) DEFAULT '' COMMENT '来源',
             `sourceUrl` varchar(1024) DEFAULT '' COMMENT '来源URL',
             `abstrat` varchar(255) NOT NULL,
             `publishedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
             `body` text COMMENT '正文',
             `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '缩略图',
             `originalThumb` varchar(255) NOT NULL DEFAULT '' COMMENT '缩略图原图',
             `picture` varchar(255) NOT NULL DEFAULT '' COMMENT '文章头图，文章编辑／添加时，自动取正文的第１张图',
             `status` enum('published','unpublished','trash') NOT NULL DEFAULT 'unpublished' COMMENT '状态',
             `hits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击量',
             `promoted` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '推荐',
             `postNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复数',
             `upsNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点赞数',
             `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文章发布人的ID',
             `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
             `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
             PRIMARY KEY (`id`),
             KEY `updatedTime` (`updatedTime`)
            ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
            CREATE TABLE `article_category` (
             `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
             `name` varchar(255) NOT NULL COMMENT '栏目名称',
             `publishArticle` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否允许发布文章',
             `published` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否启用（1：启用 0：停用)',
             `parentId` int(10) unsigned NOT NULL DEFAULT '0',
             `createdTime` int(10) unsigned NOT NULL DEFAULT '0',
             PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
            CREATE TABLE `comment` (
             `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
             `objectType` varchar(20) NOT NULL,
             `objectId` int(10) NOT NULL,
             `userId` int(10) unsigned NOT NULL DEFAULT '0',
             `toUserId` int(10) unsigned NOT NULL,
             `content` text NOT NULL,
             `createdTime` int(10) unsigned NOT NULL,
             PRIMARY KEY (`id`),
             UNIQUE KEY `id` (`id`)
            ) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;
            CREATE TABLE `topic` (
             `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
             `columnId` int(10) unsigned NOT NULL,
             `tags` varchar(255) DEFAULT '',
             `title` varchar(50) NOT NULL,
             `content` text NOT NULL,
             `userId` int(10) unsigned NOT NULL,
             `createdTime` int(10) unsigned NOT NULL,
             `updatedTime` int(10) unsigned NOT NULL DEFAULT '0',
             `goodCount` int(10) unsigned NOT NULL DEFAULT '0',
             `status` varchar(30) NOT NULL,
             PRIMARY KEY (`id`)
            ) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
            CREATE TABLE `topic_column` (
             `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
             `parentId` int(10) unsigned NOT NULL,
             `name` varchar(50) NOT NULL,
             `profile` text NOT NULL,
             `count` int(10) unsigned NOT NULL,
             `admin` varchar(100) NOT NULL,
             PRIMARY KEY (`id`)
            ) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
            CREATE TABLE `user` (
             `id` int(11) NOT NULL AUTO_INCREMENT,
             `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
             `avatar` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
             `sex` char(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
             `birthday` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
             `phoneNumber` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
             `attentionCount` int(10) unsigned NOT NULL DEFAULT '0',
             `introduce` text COLLATE utf8_unicode_ci,
             `role` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'USER',
             `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
             `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
             `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
             `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
             `status` smallint(6) NOT NULL DEFAULT '10',
             `created_at` int(11) NOT NULL,
             `updated_at` int(11) NOT NULL,
             PRIMARY KEY (`id`),
             UNIQUE KEY `username` (`username`),
             UNIQUE KEY `email` (`email`),
             UNIQUE KEY `password_reset_token` (`password_reset_token`)
            ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
            CREATE TABLE `user_album` (
             `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
             `userId` int(10) unsigned NOT NULL DEFAULT '0',
             `imgPath` varchar(128) NOT NULL DEFAULT '',
             `createdTime` int(10) unsigned NOT NULL DEFAULT '0',
             PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
