<?php

namespace frontend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\controllers\ResController;
use frontend\models\Comment;
use frontend\models\user;


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
        $content = Yii::$app->request->post('content','');
        $user = Yii::$app->user->identity;
        $comment = new Comment();
        $comment->objectId = intval($objectId);
        $comment->objectType = intval($objectType);
        $comment->content = $content;
        $comment->userId = $user->id;
        $comment->createdTime = time();
        
        if($comment->save()){

        	$data = array(
	       		'userName' => $user->username,
	       		'content' => $comment->content,
	       		'objectType' => 'user',
	       		// 'objectType' => $comment->objectType,
	       		// 'object' => $comment->objectId, 	
	       		'object' => 1, 	
	        );
	        $arr = array('userName' =>$user->username ,);
	        if ($data['objectType'] == 'user') {
	        	$userFind = User::findOne($data['object']);
	        	$data['object'] = array(
	        		'userId' => $userFind->id,
	        		'userName' => $userFind->username,
	        	); 
	        }
	   		return $Res->setStatus('200')->setMessage('success')->setData($data)->getRes();
        }
        else{
        	var_dump($comment->errors);
        	exit();
	   		return $Res->setStatus('215')->setMessage('保存失败'.$comment->errors)->getRes();
        }
    }
}




