<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class UserController extends Controller
{   
    public $layout = false;
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
    	return $this->render('login.html');
    }

    public function actionRegister()
    {
    	return $this ->render('register');
    }
}
