<?php

namespace frontend\models;

use Yii;
use frontend\models\Comment;
use common\models\Article;
use common\models\Topic;
use common\models\Answer;

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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    public function getModels($objectId,$objectType)
    {   
        if ($objectType == 'comment') {
            return Comment::find()->where(['id' => $objectId])->one();
        }elseif ($objectType == 'article') {
            return Article::find()->where(['id' => $objectId])->one();
        }elseif ($objectType == 'answer') {
            return Answer::find()->where(['id' => $objectId])->one();
        }elseif ($objectType == 'topic') {
            return Topic::find()->where(['id' => $objectId])->one();
        }
        
    }
}
