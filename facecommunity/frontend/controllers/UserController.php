<?php

namespace frontend\controllers;

class UserController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
