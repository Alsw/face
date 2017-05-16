<?php

namespace frontend\models;

use Yii;
use frontend\models\User;
/**
 * This is the model class for table "user_album".
 *
 * @property string $id
 * @property string $userId
 * @property string $imgPath
 * @property string $createdTime
 * @property string $description
 * @property string $faceId
 */
class UserAlbum extends \yii\db\ActiveRecord
{

    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_album';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'createdTime'], 'integer'],
            [['description'], 'required'],
            [['description'], 'string'],
            [['imgPath'], 'string', 'max' => 128],
            [['faceId'], 'string', 'max' => 50],
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
            'imgPath' => 'Img Path',
            'createdTime' => 'Created Time',
            'description' => 'Description',
            'faceId' => 'Face ID',
        ];
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}
