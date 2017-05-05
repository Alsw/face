<?php

namespace frontend\models;

use Yii;
use frontend\models\User;
/**
 * This is the model class for table "attention".
 *
 * @property string $id
 * @property string $userId
 * @property string $objectId
 * @property string $objectType
 * @property string $createdTime
 * @property integer $status
 */
class Attention extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attention';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'objectId', 'objectType', 'createdTime'], 'required'],
            [['id', 'userId', 'objectId', 'createdTime', 'status'], 'integer'],
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
            'userId' => 'User ID',
            'objectId' => 'Object ID',
            'objectType' => 'Object Type',
            'createdTime' => 'Created Time',
            'status' => 'Status',
        ];
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
    public function getPerson()
    {  
        if ($this->objectType == 'user') {
            return $this->hasOne(User::className(), ['id' => 'objectId']);
        }
    }
}