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
        if ($sort === 'all') {

            $data = Topic::find();
            $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '2']);
            $model = $data->offset($pages->offset)->limit($pages->limit)->all();

            return $this->render('index',['models' => $model, 'pages' => $pages]);
        }
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

    	$Column = new TopicColumn();
    	$ColumnData = ['zero' => $Column->findColumns(0),'one' =>$Column->findColumns(1)];
        return $this->render('add-topic',['model' => $model,'datas' => $ColumnData]); 
    }
    public function actionDetail($id)
    {
        $model = Topic::findone(['id'=>$id]);
        $CommentSearch = new Comment();
        $Comment = $CommentSearch->findComments($id,'topic');
        
        return $this->render('topic-detail',['model'=>$model,'comment' => $Comment]);
    }

    public function actionColumn()
    {   

        $Res = new ResController();
        $parentId = Yii::$app->request->post('parentId','');
        $Column = new TopicColumn();
        $data = $Column->findColumns($parentId);


        return $Res->setStatus(200)->setMessage('success')->setData($data)->getRes();
    }

}
