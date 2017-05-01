<?php

namespace frontend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\controllers\ResController;
use frontend\models\Comment;
use frontend\models\User;
use yii\helpers\Json;


class CommentController extends \yii\web\Controller
{   

    public function actionCreate()
    {   
        $Res = new ResController();
        $data = [];
        if (Yii::$app->user->isGuest) {
            return $Res->setStatus('205')->setMessage('请登录')->getRes();
        }


        $objectId = Yii::$app->request->post('objectId','');
        $objectType = Yii::$app->request->post('objectType','');
        $toUserId = Yii::$app->request->post('toUserId','');
        $content = Yii::$app->request->post('content','');
        

        $user = Yii::$app->user->identity;
        $comment = new Comment();
        $comment->objectId = intval($objectId);
        $comment->objectType = $objectType;
        $comment->content = $content;
        $comment->userId = $user->id;
        $comment->toUserId = $toUserId; 
        $comment->createdTime = time();
        
        if($comment->save()){
            $user = $comment->user;
        	$data = array(
    	       	 'content' => $comment->content,
	       		 'objectType' => $comment->objectType,
	       		 'object' => $comment->objectId,
                 'createdTime' => $comment->createdTime,
                 'userId' => $user->id, 
                 'userAvatar' => $user->avatar,
                 'userName' => $user->username,
	        );
	   		return $Res->setStatus('200')->setMessage('success')->setData($data)->getRes();
        }
        else{
	   		return $Res->setStatus('215')->setMessage($comment->errors)->getRes();
        }
    }
    public function actionShow()
    {
        $Res = new ResController();

        $objectId = Yii::$app->request->post('objectId','');
        $objectType = Yii::$app->request->post('objectType','');
        
        $models = Comment::find()->where([
            'objectId' => $objectId,
            'objectType' => $objectType,
        ])->orderBy('createdTime ASC')->all();
        $array = array();
        foreach ($models as $key => $value) {
            $array[$key] = [
            'value' => $value, 
            'userId'=> $value->user->id,
            'userName'=> $value->user->username,
            'userAvatar'=> $value->user->avatar,
            'toUser'=> $value->toUser->username,
            'createdTime' =>Yii::$app->formatter->asRelativeTime($value->createdTime)
            ];
        }
        return Json::encode($array);
             

    }
}




