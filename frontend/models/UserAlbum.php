<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_album".
 *
 * @property string $id
 * @property string $userId
 * @property string $imgPath
 * @property string $createdTime
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
            [['imgPath'], 'string', 'max' => 128],
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
        ];
    }
}
