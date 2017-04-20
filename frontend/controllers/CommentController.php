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
    	       	 'content' => $comment->content,
	       		 'objectType' => $comment->objectType,
	       		 'object' => $comment->objectId, 	
	        );




	        $arr = array('userName' =>$user->username ,);
	        if ($data['objectType'] == 'user') {
	        	$userFind = User::findOne($data['object']);
	        	$data['object'] = array(
	        		'userId' => $userFind->id,
	        		'userName' => $userFind->username,
	        		'userImg' => $userFind->avatar
	        	); 
	        }
	   		return $Res->setStatus('200')->setMessage('success')->setData($data)->getRes();
        }
        else{
	   		return $Res->setStatus('215')->setMessage('保存失败'.$comment->errors)->getRes();
        }
    }

    protected function findModels($id)
    {   
        $modelArr = array();
        if (($models = Comment->find(['objectType'=>'Comment','objectId' => $id ])->all()) !== null) {
            array_push($modelArr, $models);
            foreach ($models as  $value) {
                $this->findModels($value->objectId);
            }
        }
        return $modelArr;
    }

    protected function findObjectModel($objectId, $objectType)
    {
        if (($models = Comment::find('objectId' => $objectId, 'objectType' => $objectType)->all()) !== null) {
            return $models;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}




