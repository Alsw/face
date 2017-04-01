<?php

namespace frontend\controllers;

use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class UserController extends Controller
{   
    public $layout = "face";
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {   
        $postData = Yii::$app->request->post();
        if(empty($postData)){
            return $this->render('login');
        }else{
            return $this -> render('register');
        }
    }

    public function actionRegister()
    {
    	return $this ->render('register');
    }
}
