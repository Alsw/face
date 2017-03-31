<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "session".
 *
 * @property string $id
 * @property string $name
 * @property string $profile
 * @property string $count
 */
class Session extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'session';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'profile', 'count'], 'required'],
            [['count'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['profile'], 'string', 'max' => 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'profile' => 'Profile',
            'count' => 'Count',
        ];
    }
}
