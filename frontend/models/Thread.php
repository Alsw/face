<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "thread".
 *
 * @property string $id
 * @property string $sessionId
 * @property string $userId
 * @property string $title
 * @property string $content
 * @property string $createTime
 * @property string $status
 * @property string $commetCount
 */
class Thread extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'thread';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sessionId', 'userId', 'title', 'content', 'createTime', 'status', 'commetCount'], 'required'],
            [['sessionId', 'userId', 'createTime', 'status', 'commetCount'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sessionId' => 'Session ID',
            'userId' => 'User ID',
            'title' => 'Title',
            'content' => 'Content',
            'createTime' => 'Create Time',
            'status' => 'Status',
            'commetCount' => 'Commet Count',
        ];
    }
}
