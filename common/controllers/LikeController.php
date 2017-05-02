<?php
namespace common\controllers;

use yii\base\object;
use frontend\models\Likes;
/**
* 
*/
class LikeController extends object
{	
	public function isLike($objectId,$objectType)
    {   
        
        return Likes::find()->where(['objectId' =>$objectId,'objectType'=> $objectType,'userId' => Yii::$app->user->identity->id])->all();
    }
    public function likeCount($objectId,$objectType)
    {
         return Likes::find()->where(['objectId' =>$objectId,'objectType'=> $objectType])->count();
    }
}