<?php

namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use frontend\models\Article;
use frontend\models\User;
use frontend\models\ArticleCategory;



class ArticleController extends \yii\web\Controller
{
    public $layout = "face";
    public $enableCsrfValidation = true;

    public function actionIndex()
    {   
        $article = new Article();
        $article_count = $article->find()->count();
        $articleAll = $article->find()->all();
        $category = ArticleCategory::find()->all();
        $categoryIds = array();
        foreach ($category as $key => $value) {
            $categoryIds[$value->id] = $value->name;
        }
        return $this->render('index',[
            'datas' => $articleAll,
            'categoryName' => $categoryIds,
            ]);
    }
    public function actionDetial($id)
    {
        return $this->render('articledetial');
    }

    public function actionCategory($id)
    {
        return $this->render('articledetial');
    }

}
