<?php

namespace frontend\controllers;

class ArticleController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
