<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dynamic".
 *
 * @property string $id
 * @property string $userId
 * @property string $content
 * @property string $createdTime
 * @property string $deletedTime
 * @property string $status
 * @property string $type
 */
class Dynamic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dynamic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'content', 'createdTime', 'deletedTime', 'status', 'type'], 'required'],
            [['userId', 'createdTime', 'deletedTime', 'status', 'type'], 'integer'],
            [['content'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'content' => 'Content',
            'createdTime' => 'Created Time',
            'deletedTime' => 'Deleted Time',
            'status' => 'Status',
            'type' => 'Type',
        ];
    }
}
