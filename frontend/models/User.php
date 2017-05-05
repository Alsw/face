<?php

namespace frontend\models;

use Yii;
use frontend\models\Attention;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $avatar
 * @property string $sex
 * @property string $birthday
 * @property string $phoneNumber
 * @property string $role
 * @property string $attentionCount
 * @property string $introduce
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
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['attentionCount', 'status', 'created_at', 'updated_at'], 'integer'],
            [['introduce'], 'string'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['avatar'], 'string', 'max' => 128],
            [['sex'], 'string', 'max' => 2],
            [['birthday', 'phoneNumber'], 'string', 'max' => 20],
            [['role', 'auth_key'], 'string', 'max' => 32],
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
            'role' => 'Role',
            'attentionCount' => 'Attention Count',
            'introduce' => 'Introduce',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function isAttention()
    {   
        $id = Yii::$app->user->identity->id;
        $data = Attention::find()->where([
            'userId' => $id,
            'objectType' => 'user',
            'objectId' => $this->id,
            ])->one();
        if (empty($data)) {
            return false;
        }
        return true;
    }

    public function myAttention()
    {
        $data = Attention::find()->where([
            'userId' => $this->id,
            'objectType' => 'user',
            ])->all();
        return $data;
    }
    public function attentionMe()
    {
        $data = Attention::find()->where([
            'objectId' => $this->id,
            'objectType' => 'user',
            ])->all();
        return $data;
    }
}
