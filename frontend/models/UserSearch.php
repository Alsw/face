<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\User;

class UserSearch extends User 
{	
	

    public function findModel($id)
    {
        $user = User::findOne($id);
        $models = array(
            'id' => $user->id , 
            'username' => $user->username,
            'avatar' => $user->avatar
            );

        return $models;
    }
	
}