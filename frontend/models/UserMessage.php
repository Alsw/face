<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_message".
 *
 * @property string $id
 * @property string $userId
 * @property string $selfIntroduce
 */
class UserMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'selfIntroduce'], 'required'],
            [['userId'], 'integer'],
            [['selfIntroduce'], 'string'],
            [['userId'], 'unique'],
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
            'selfIntroduce' => 'Self Introduce',
        ];
    }
}
