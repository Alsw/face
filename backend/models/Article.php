<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property string $id
 * @property string $title
 * @property string $categoryId
 * @property string $tagIds
 * @property string $source
 * @property string $sourceUrl
 * @property string $publishedTime
 * @property string $body
 * @property string $thumb
 * @property string $originalThumb
 * @property string $picture
 * @property string $status
 * @property string $hits
 * @property integer $promoted
 * @property string $postNum
 * @property string $upsNum
 * @property string $userId
 * @property string $createdTime
 * @property string $updatedTime
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['categoryId', 'publishedTime', 'hits', 'promoted', 'postNum', 'upsNum', 'userId', 'createdTime', 'updatedTime'], 'integer'],
            [['body', 'status'], 'string'],
            [['title', 'tagIds', 'thumb', 'originalThumb', 'picture'], 'string', 'max' => 255],
            [['source', 'sourceUrl'], 'string', 'max' => 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'categoryId' => 'Category ID',
            'tagIds' => 'Tag Ids',
            'source' => 'Source',
            'sourceUrl' => 'Source Url',
            'publishedTime' => 'Published Time',
            'body' => 'Body',
            'thumb' => 'Thumb',
            'originalThumb' => 'Original Thumb',
            'picture' => 'Picture',
            'status' => 'Status',
            'hits' => 'Hits',
            'promoted' => 'Promoted',
            'postNum' => 'Post Num',
            'upsNum' => 'Ups Num',
            'userId' => 'User ID',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
        ];
    }
}
