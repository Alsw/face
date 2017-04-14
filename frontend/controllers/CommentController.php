<?php

namespace frontend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
// use common\controllers\ResController;

class CommentController extends \yii\web\Controller
{   
    public $enableCsrfValidation = false;

    public function actionCreate()
    {   
        // $Res = new ResController();

        // if (Yii::$app->user->isGuest) {
        //     return $Res->setStatus('205')->setMessage('请登录')->getRes();
        // }
        
        // return $Res->setStatus('200')->setMessage('success')->setData($aa)->getRes();     
        echo "123";   
        return true;
    }
    
}
