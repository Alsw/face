<?php

namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use common\models\Article;
use frontend\models\User;
use common\models\ArticleCategory;



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
        $category = ArticleCategory::find()->all();
        $categoryIds = array();
        foreach ($category as $key => $value) {
            $categoryIds[$value->id] = $value->name;
        }
        return $this->render('articledetial',[
            'categoryName' => $categoryIds,
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCategory($id)
    {
        return $this->render('articledetial');
    }
     protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
