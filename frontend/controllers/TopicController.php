<?php

namespace frontend\controllers;
use Yii;
use common\models\Topic;
use common\models\TopicColumn;
use common\models\LoginForm;
use common\controllers\ResController;
use common\models\TopicSearch;
use yii\data\Pagination; 
use frontend\models\Comment;

class TopicController extends \yii\web\Controller
{	

	public $layout = "face";
    
    public function actions()
    {
        return [
            'upload'=>[
                'class' => 'common\widgets\file_upload\UploadAction',     //这里扩展地址别写错
                'config' => [
                    'imageUrlPrefix' => "http://www.facefrontend.com",
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}",
                ]
            ],
             'ueditor'=>[
                'class' => 'common\widgets\ueditor\UeditorAction',
                'config'=>[
                    //上传图片配置
                    'imageUrlPrefix' => "http://www.facefrontend.com", /* 图片访问路径前缀 */
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}",
                    'initialFrameHeight' => '400',
                     /* 上传保存路径,可以自定义保存路径和文件名格式 */
                ]
            ],

        ];
    }
    public function actionIndex()
    {   
        $sort = Yii::$app->request->get('sort', 'all');
        $columns = $this->findColumns();
       
        if (is_numeric($sort)) {
            $data = Topic::find()->where(['columnId'=>$sort])->orderBy('createdTime DESC');
        }else if ($sort === 'all') {

             $data = Topic::find()->orderBy('id DESC');

        }else if($sort ==='new'){

             $data = Topic::find()->orderBy('createdTime DESC');

        }else if($sort === 'hot'){

             $data = Topic::find()->orderBy('goodCount DESC');

        }else if($sort === 'week'){

             $data = Topic::find()->where(['>', 'createdTime', time()-604800])->orderBy('createdTime DESC');

        }else if($sort === 'month'){

             $data = Topic::find()->where(['>', 'createdTime', time()-2592000])->orderBy('createdTime DESC');

        }else{

             $data = Topic::find()->orderBy('id ASC');

        }

        $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '5']);
        $model = $data->offset($pages->offset)->limit($pages->limit)->all();
         return $this->render('index',[
                'models' => $model, 
                'columns'=>$columns, 
                'pages' => $pages
        ]);
    }

    public function actionAddtopic()
    {	
       
		if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
    	$model = new Topic();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect('index');
        }
        $columns = $this->findColumns();

    	$Column = new TopicColumn();
    	$ColumnData = ['zero' => $Column->findColumn(0),'one' =>$Column->findColumn(1)];
        return $this->render('add-topic',[
            'model' => $model,
            'datas' => $ColumnData,
            'columns'=>$columns
            ]); 
    }
    public function actionDetail($id)
    {
        $model = Topic::findone(['id'=>$id]);
        $columns = $this->findColumns();
       
        $CommentSearch = new Comment();
        $Comment = $CommentSearch->commentsAsArray($id,'topic');
              
        return $this->render('topic-detail',[
            'model'=>$model,
            'comment' => $Comment,
            'columns' => $columns
            ]);
    }

    public function findColumns()
    {   

        $models = TopicColumn::find()->where(['parentId'=>0])->all();
        foreach ($models as $key => $value) {
            $value->children = TopicColumn::find()->where(['parentId'=>$value->id])->all();
        }
        return $models;
    }

}
