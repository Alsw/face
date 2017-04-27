<?php

namespace common\models;

use Yii;
use common\models\User;
use common\models\TopicColumn;
use yii\helpers\Json;
use common\components\Helper;
/**
 * This is the model class for table "topic".
 *
 * @property string $id
 * @property string $tags
 * @property string $columnId
 * @property string $title
 * @property string $content
 * @property string $userId
 * @property string $createdTime
 * @property string $updatedTime
 * @property string $goodCount
 * @property string $status
 */
class Topic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $parentId;
    public static function tableName()
    {
        return 'topic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['columnId', 'title', 'content', 'tags'], 'required','message'=>'lost data'],
            [['columnId', 'userId', 'createdTime', 'updatedTime', 'goodCount'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 50],
            [['status'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tags' => 'Tag',
            'columnId' => 'Column ID',
            'title' => 'Title',
            'content' => 'Content',
            'userId' => 'User ID',
            'createdTime' => 'Createed Time',
            'updatedTime' => 'Updated Time',
            'goodCount' => 'Good Count',
            'status' => 'Status',
        ];
    }
    public function beforeSave($insert)  
    {  
        if(parent::beforeSave($insert)){  
            if($this->isNewRecord){
                $this->tags = Json::encode($this->tags);  
                $this->createdTime = time();
                $this->updatedTime = time();   
                $this->status = 'published';
                $this->userId = Yii::$app->user->identity->id;
            }else{  
                $this->updatedTime = time();   
            }  
            return true;  
        }else{  
            return false;  
        }  
    } 

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
    public function getColumn()
    {
        return $this->hasOne(TopicColumn::className(), ['id' => 'columnId']);
    }
    public function getAbstrat()
    {
        return Helper::truncate_utf8_string($this->content,100);
    }
}
