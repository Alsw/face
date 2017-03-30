<?php

namespace frontend\controllers;

use Yii;

class UserController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
