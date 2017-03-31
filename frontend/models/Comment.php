<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property string $id
 * @property integer $objectType
 * @property string $objectId
 * @property string $userId
 * @property string $content
 * @property string $createdTime
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['objectType', 'objectId', 'content', 'createdTime'], 'required'],
            [['objectType', 'objectId', 'userId', 'createdTime'], 'integer'],
            [['content'], 'string'],
            [['objectType'], 'unique'],
            [['objectId'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'objectType' => 'Object Type',
            'objectId' => 'Object ID',
            'userId' => 'User ID',
            'content' => 'Content',
            'createdTime' => 'Created Time',
        ];
    }
}
