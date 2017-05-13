<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $avatar
 * @property string $sex
 * @property string $birthday
 * @property string $phoneNumber
 * @property string $attentionCount
 * @property string $introduce
 * @property string $role
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'birthday', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['attentionCount', 'status', 'created_at', 'updated_at'], 'integer'],
            [['introduce'], 'string'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['avatar', 'role'], 'string', 'max' => 128],
            [['sex'], 'string', 'max' => 2],
            [['birthday'], 'string', 'max' => 12],
            [['phoneNumber'], 'string', 'max' => 20],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'avatar' => 'Avatar',
            'sex' => 'Sex',
            'birthday' => 'Birthday',
            'phoneNumber' => 'Phone Number',
            'attentionCount' => 'Attention Count',
            'introduce' => 'Introduce',
            'role' => 'Role',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
