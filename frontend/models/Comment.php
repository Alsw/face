<?php

namespace frontend\models;

use Yii;
use frontend\models\User;

/**
 * This is the model class for table "comment".
 *
 * @property string $id
 * @property string $objectType
 * @property integer $objectId
 * @property string $userId
 * @property string $toUserId
 * @property string $content
 * @property string $createdTime
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $children;
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
            [['objectType', 'objectId', 'toUserId', 'content', 'createdTime'], 'required'],
            [['objectId', 'userId', 'toUserId', 'createdTime'], 'integer'],
            [['content'], 'string'],
            [['objectType'], 'string', 'max' => 20],
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
            'toUserId' => 'To User ID',
            'content' => 'Content',
            'createdTime' => 'Created Time',
        ];
    }
    public function getUser()
    {

        return $this->hasOne(User::className(), ['id' => 'userId']);

    }
    public function getToUser()
    {
        return $this->hasOne(User::className(), ['id' => 'toUserId']);
    }

    public function findComments($objectId,$objectType)
    {
        $data = Comment::find()->where(['objectId'=>$objectId, 'objectType'=>$objectType,'toUserId' => 0])->all();
        foreach ($data as $value) {
            $value->children = Comment::find()->where(['objectId' => $value['id'], 'objectType'=>'comment'])->all();
        }

        return $data;

    }

}
