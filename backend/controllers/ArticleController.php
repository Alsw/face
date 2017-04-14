<?php

namespace backend\controllers;

use Yii;
use common\models\Article;
use app\models\ArticleSearch;
use common\models\ArticleCategory;
use app\models\ArticleCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = "face";
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
       public function actions()
    {
        return [
            'upload'=>[
                'class' => 'common\widgets\file_upload\UploadAction',     //这里扩展地址别写错
                'config' => [
                    'imageUrlPrefix' => "http://www.facebackend.com", 
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}",
                ]
            ],
             'ueditor'=>[
                'class' => 'common\widgets\ueditor\UeditorAction',
                'config'=>[
                    //上传图片配置
                    'imageUrlPrefix' => "http://www.facebackend.com", /* 图片访问路径前缀 */
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}",
                    'initialFrameHeight' => '400',
                     /* 上传保存路径,可以自定义保存路径和文件名格式 */
                ]
            ],
        ];
    }
    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();
        if ($model->load(Yii::$app->request->post())) {

        	$data = Yii::$app->request->post('Article','');
	       	$tagIds = implode(',', $data['tagIds']); 
	       	$model->tagIds = $tagIds; 
	        $model->createdTime = time();
	        $model->updatedTime = 0;
	        $model->userId = Yii::$app->user->identity->id;
            if (empty($data['abstrat'])) {
                $model->abstrat = mb_substr($data['body'], 0,200); 
            }

        	if ($model->save()) {
           	 	return $this->redirect(['view', 'id' => $model->id]);
        	}
        } else {

            $CategoryIds = ArticleCategory::find()->all();
            $datas = array();
            foreach ($CategoryIds as $key => $data) {
                $datas[$data->id] = $data->name;
            }
            return $this->render('create', [
                'model' => $model,
                'datas' => $datas,
            ]);
        }
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {   

        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) ) {
        	$model->updatedTime = time();
        	$data = Yii::$app->request->post('Article','');
	       	$tagIds = implode(',', $data['tagIds']); 
	       	$model->tagIds = $tagIds;
        	if ($model->save()) {
	            return $this->redirect(['view', 'id' => $model->id]);
        	}
        } else {
        	$model->tagIds = explode(',',$model->tagIds);
            $CategoryIds = ArticleCategory::find()->all();
            $datas = array();
            foreach ($CategoryIds as $key => $data) {
                $datas[$data->id] = $data->name;
            }
            return $this->render('update', [
                'model' => $model,
                'datas' => $datas,
            ]);
        }
    }


    public function actionPublish($id)
    {
        $model = $this->findModel($id);
        $model->status = 'published';
        $model->publishedTime = time();
        if ($model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
