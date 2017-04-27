<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $sex;
    public $birthday;
    public $phonenumber;
    public $introduce;
    public $status;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required','message'=>'不能为空'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '用户名已经存在'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email','message'=>'邮箱格式不正确'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => '该邮箱已经存在'],

            ['password', 'required', 'message'=> '密码不能为空'],
            ['password', 'string', 'min' => 6],

            ['birthday', 'required', 'message'=> '生日不能为空'],

            ['phonenumber','number'],
            ['phonenumber','string', 'min' => 11],
            ['phonenumber', 'filter', 'filter' => 'trim'],
            ['phonenumber', 'required', 'message'=> '电话号码不能为空'],
            ['phonenumber', 'unique','targetClass' => '\common\models\User','message'=> '手机号码已存在'],
            [['phonenumber'],'match','pattern'=>'/^0{0,1}(13[0-9]|15[7-9]|153|156|18[7-9])[0-9]{8}$/','message'=>'请输入正确的手机号码'],  

            ['sex','required','message'=>'请选择性别'],
            ['introduce','string'],   
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    protected function beforeSave($insert)  
    {  
        if(parent::beforeSave($insert)){  
            if($this->isNewRecord){  
                $this->create_at = time();  
                $this->status = '0';
            }else{  
                $this->update_at = time();   
            }  
            return true;  
        }else{  
            return false;  
        }  
    }  
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
                
        $user = new User();
        $user->avatar = '/images/avatar.jpg';
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->phoneNumber = $this->phonenumber;
        $user->birthday = $this->birthday;
        $user->sex = $this->sex;
        $user->introduce = $this->introduce;
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }
}
