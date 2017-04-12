<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "article_category".
 *
 * @property string $id
 * @property string $name
 * @property integer $publishArticle
 * @property integer $published
 * @property string $parentId
 * @property string $createdTime
 */
class ArticleCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['publishArticle', 'published', 'parentId', 'createdTime'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'publishArticle' => 'Publish Article',
            'published' => 'Published',
            'parentId' => 'Parent ID',
            'createdTime' => 'Created Time',
        ];
    }
}
