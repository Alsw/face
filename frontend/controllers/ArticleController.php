<?php

namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use common\models\Article;
use frontend\models\User;
use common\models\ArticleCategory;
use frontend\models\CommentSearch;
use frontend\models\UserSearch;



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
        $comment = new CommentSearch();
        $userSearch = new UserSearch();
        $CommentModels  = $comment->findObjectModel($id, 3);
            
        foreach ($CommentModels as $key => $value) {
            //$CommentModels[$key]->user = $userSearch->findModel($value->userId);
        }
        // foreach ($CommentModels as $value) {
        //     $Ccomments = $comment->findModels($value->id)->returnModels();
        // }



        $category = ArticleCategory::find()->all();
        $categoryIds = array();
        foreach ($category as $key => $value) {
            $categoryIds[$value->id] = $value->name;
        }
        return $this->render('article-detial',[
            'categoryName' => $categoryIds,
            'model' => $this->findModel($id),
            'CommentModels' => $CommentModels,
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
