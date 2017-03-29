<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article_like".
 *
 * @property string $id
 * @property string $articleId
 * @property string $userId
 * @property string $createTime
 */
class ArticleLike extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_like';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['articleId', 'userId', 'createTime'], 'required'],
            [['articleId', 'userId', 'createTime'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'articleId' => 'Article ID',
            'userId' => 'User ID',
            'createTime' => 'Create Time',
        ];
    }
}
