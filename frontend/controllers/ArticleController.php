<?php

namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use common\models\Article;
use frontend\models\User;
use common\models\ArticleCategory;
use frontend\models\Comment;
use frontend\models\CommentSearch;
use yii\data\Pagination; 


class ArticleController extends \yii\web\Controller
{
    public $layout = "face";
    public $enableCsrfValidation = true;

    public function actionIndex()
    {   

        $data = Article::find()->orderBy('createdTime DESC');
        $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '2']);
        $model = $data->offset($pages->offset)->limit($pages->limit)->all();
        $category = ArticleCategory::find()->all();
    
        return $this->render('index', [
            'datas' => $model,
            'pages' => $pages,
            'categoryName' => $category,
        ]);
    }
    public function actionDetial($id)
    {   
        $CommentSearch = new Comment();
        $Comment = $CommentSearch->findComments($id,'article');

        $category = ArticleCategory::find()->all();
        $categoryIds = array();
        foreach ($category as $key => $value) {
            $categoryIds[$value->id] = $value->name;
        }

       


        return $this->render('article-detial',[
            'categoryName' => $categoryIds,
            'model' => $this->findModel($id),
            'comment' => $Comment,
        ]);
    }
    public function actionCategory($id)
    {   
        $article = new Article();
        $article_count = $article->find()->count();
        $articleAll = $article->find()->where(['categoryId' => $id])->all();
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

    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
