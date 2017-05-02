<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "likes".
 *
 * @property string $id
 * @property string $objectId
 * @property string $objectType
 * @property string $userId
 * @property string $createdTime
 */
class Likes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'likes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['objectId', 'objectType', 'userId', 'createdTime'], 'required'],
            [['objectId', 'userId', 'createdTime'], 'integer'],
            [['objectType'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'objectId' => 'Object ID',
            'objectType' => 'Object Type',
            'userId' => 'User ID',
            'createdTime' => 'Created Time',
        ];
    }

    
}
