<?php

namespace frontend\controllers;

class FaceController extends \yii\web\Controller
{	
    public $layout = "face";
	
    public function actionIndex()
    {
        return $this->render('index');
    }

}
