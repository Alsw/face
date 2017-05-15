<?php

namespace frontend\models;

use Yii;
use frontend\models\User;
use frontend\models\Likes;
use frontend\models\Article;
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
       
        $data = Comment::find()->where(['objectId'=>$objectId, 'objectType'=>$objectType,'toUserId' => 0])->orderBy('createdTime DESC')->all();
        foreach ($data as $value) {
            $value->children = Comment::find()->where(['objectId' => $value['id'], 'objectType'=>'comment'])->orderBy('createdTime ASC')->all();
        }

        return $data;

    }
    public function commentsAsArray($objectId,$objectType)
    {
        $data = Comment::find()->where(['objectId'=>$objectId, 'objectType'=>$objectType,'toUserId' => 0])->orderBy('createdTime DESC')->all();
        foreach ($data as $value) {
            $array = Comment::find()->where(['objectId' => $value['id'], 'objectType'=>'comment'])->orderBy('createdTime DESC')->all();
            $value->children = $array;
            $data = array_merge($data, $array);
        }
        return $data;
    }

    public function isLikes()
    {   
        $isLike = Likes::find()->where(['objectId' =>$this->id,'objectType'=> 'comment','userId' => Yii::$app->user->identity->id])->one();

        if (!empty($isLike)) {
            $isLike = true;
        }else{
            $isLike = false;
        }

        $likeCount = Likes::find()->where(['objectId' =>$this->id,'objectType'=> 'comment'])->count();
        $data = ['islike'=>$isLike,'likeCount'=> $likeCount];
        
        return $data;
    }
    
   
}
