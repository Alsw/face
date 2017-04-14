<?php

use yii\db\Migration;

class m170414_081941_article extends Migration
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
            ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8
    ";
     $this->execute($sql);
    }

    public function down()
    {
        echo "m170414_081941_article cannot be reverted.\n";

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
