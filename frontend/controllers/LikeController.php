<?php

namespace frontend\controllers;

use yii;
use frontend\models\Likes;
use common\controllers\ResController;
use common\models\Article;

class LikeController extends \yii\web\Controller
{
	public function actionCreate()
	{
        $Res = new ResController();

        $objectId = Yii::$app->request->post('objectId','');
        $objectType = Yii::$app->request->post('objectType','');

        $Likes = new Likes();

        $Likes->objectType = $objectType;
        $Likes->objectId = $objectId;
        $Likes->userId = Yii::$app->user->identity->id;
        $Likes->createdTime = time();

        if ($Likes->objectType == 'article') {
            $articleModel = Article::findone(['id'=> $Likes->objectId]);
            $articleModel->upsNum  = count(Likes::find()->where(['objectId'=>$articleModel->id,'objectType' => $Likes->objectType])->all());
            $articleModel->save();
        }

        if ($Likes->save()) {
        	return $Res->setStatus('200')->setMessage('success')->getRes();
        }else{
        	return $Res->setStatus('400')->setMessage('error')->getRes();
        }


	}
	public function actionDelete()
	{
        $Res = new ResController();

        $objectId = Yii::$app->request->post('objectId','');
        $objectType = Yii::$app->request->post('objectType','');

       
        $model =Likes::find()->where([
            'objectId'=>$objectId,
            'objectType' => $objectType,
            'userId'=> Yii::$app->user->identity->id
            ])->one(); 

        if ($model->delete()) {
            return $Res->setStatus('200')->setMessage('success')->getRes();
        }else{
            return $Res->setStatus('400')->setMessage('error')->getRes();
        }

	}
}
