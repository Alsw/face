<?php

namespace common\models;

use Yii;
use frontend\models\Comment;
use common\models\User;
use common\models\Topic;
use common\components\Helper;
use frontend\models\Likes;
/**
 * This is the model class for table "answer".
 *
 * @property integer $id
 * @property integer $topicId
 * @property integer $userId
 * @property string $content
 * @property integer $createdTime
 * @property integer $updatedTime
 * @property integer $goodCount
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['topicId', 'userId', 'content', 'createdTime'], 'required'],
            [['topicId', 'userId', 'createdTime', 'updatedTime', 'goodCount'], 'integer'],
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
            'topicId' => 'Topic ID',
            'userId' => 'User ID',
            'content' => 'Content',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'goodCount' => 'Good Count',
        ];
    }
    
    public function getAbstrat()
    {
        return Helper::truncate_utf8_string($this->content,100);
    }
    public function getTopic()
    {
        return $this->hasOne(Topic::className(), ['id' => 'topicId']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
    public function isLikes()
    {   
        $isLike = Likes::find()->where(['objectId' =>$this->id,'objectType'=> 'answer','userId' => Yii::$app->user->identity->id])->one();

        if (!empty($isLike)) {
            $isLike = true;
        }else{
            $isLike = false;
        }

        $likeCount = Likes::find()->where(['objectId' =>$this->id,'objectType'=> 'answer'])->count();
        $data = ['islike'=>$isLike,'likeCount'=> $likeCount];
        
        return $data;
    }

    public function commentsAsArray()
    {
        $data = Comment::find()->where(['objectId'=>$this->id, 'objectType'=>'answer','toUserId' => 0])->orderBy('createdTime DESC')->all();
        foreach ($data as $value) {
            $array = Comment::find()->where(['objectId' => $value['id'], 'objectType'=>'comment'])->orderBy('createdTime DESC')->all();
            $value->children = $array;
            $data = array_merge($data, $array);
        }
        return $data;
    }
}
