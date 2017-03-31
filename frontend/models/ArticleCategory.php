<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article_category".
 *
 * @property string $id
 * @property string $name
 * @property string $code
 * @property integer $weight
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
            [['name', 'code'], 'required'],
            [['weight', 'publishArticle', 'published', 'parentId', 'createdTime'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 64],
            [['code'], 'unique'],
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
            'code' => 'Code',
            'weight' => 'Weight',
            'publishArticle' => 'Publish Article',
            'published' => 'Published',
            'parentId' => 'Parent ID',
            'createdTime' => 'Created Time',
        ];
    }
}
