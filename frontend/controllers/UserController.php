<?php

namespace frontend\controllers;

use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\userData;
use frontend\models\SignupForm;
use frontend\models\Attention;
use frontend\models\User;
use frontend\models\UserAlbum;
use frontend\models\Likes;
use common\models\Answer;
use common\models\Topic;
use common\components\HttpClient;
use common\components\Foo;
use common\models\Article;




class UserController extends Controller
{   
    public $layout = "face";
    public $enableCsrfValidation = true;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'upload'=>[
                'class' => 'common\widgets\file_upload\UploadAction',     //这里扩展地址别写错
                'config' => [
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}",
                    'imageMaxSize' => 2*1024*1024,
                ]
            ],
        ];
    }

    public function actionIndex()
    {   
        $models = Article::find()->where(['promoted' => 1])->orderBy('hits DESC')->limit(5)->all();
        $userModels = User::find()->orderBy('attentionCount')->limit(5)->all();
        
        return $this->render('index',['models' => $models, 'userModels' => $userModels]);
    }

    public function actionLogin()
    {   
       if (!Yii::$app->user->isGuest) {
            return $this->goBack();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
         
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    public function actionLogout()
    {   
        Yii::$app->user->logout();
        return $this->goBack();
    }

    public function actionRegister()
    {
    	$model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goBack();
                }
            }
        }
        return $this->render('register', [
            'model' => $model,
        ]);
    }
    public function actionMe()
    {   
        if (Yii::$app->user->isGuest) {
            return render('login');
        }

        $model = Yii::$app->user->identity;
        return $this->render('me',[
            'model' => $model,
            ]);
    }
    public function actionPersonedit()
    {   
        $user = Yii::$app->user->identity;
        $userImg = UserAlbum::find(['userId' => $user->id])->all();
        $model = [
            'user' => $user,
            'userImg' => $userImg
        ];
       
        return $this->render('personedit',[
            'model' => $model,
            ]);
    }
    public function actionPersonupdate(){
        $user = Yii::$app->user->identity;
        $model = User::findone(['id'=>$user->id]);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
               return $this->redirect(['person','id'=>$model->id]);
            }
        }
    }
    public function actionPerson($id)
    {   
        $user = $id;

        //推荐相似人
        $data = array(
            "faceset_id" => "HMr2zcdYnspTI0CdQz7mTKfDDtZRFgNz3FmwXLVv",
            "face_id" => "",
            "limit" => '5',
        );
        $arrs = array();
        $likeUsers = array();
        $img_face_id = UserAlbum::find()->where(['userId'=>$id])->all();
        foreach ($img_face_id as $value) {
            if (!empty($value->faceId) && $value->id != 0) {
                $data['face_id'] = $value->faceId; 

            $result = HttpClient::sendHttp('http://faceset.market.alicloudapi.com', '/v2/recognition/compare_face_faceset', $data);
                foreach ($result['scores'] as $item) {
                    $arrs[$item['face_id']] =$item['score'];
                }
            }
            
        }

        $keys = array_keys($arrs);
        foreach ($keys as $key => $value) {
           $likes = UserAlbum::findone(['faceId'=>$value]);

           if ($likes->userId != Yii::$app->user->identity->id) {
                $likes->user->faceDatas = [$value => $arrs[$value]];
                array_push($likeUsers, $likes->user);
           }
        }
       

        $sort = Yii::$app->request->get('sort', 'dynamic');
        $model = User::findone(['id'=>$id]);
        $model->likeUsers = $likeUsers;
        if ($sort === 'dynamic') {
          $data = Likes::find()->where(['userId'=>$user])->all();  
          return $this->render('me',['model' => $model,'data'=>$data,'type'=> 'dynamic']);
        }elseif ($sort === 'answer') {
          $data = Answer::find()->where(['userId'=>$user])->all();  
          return $this->render('me',['model' => $model,'data'=>$data,'type'=> 'answer']);
        }elseif ($sort === 'topic') {
          $data = Topic::find()->where(['userId'=>$user])->all();  
           return $this->render('me',['model' => $model,'data'=>$data,'type'=> 'topic']);
        }elseif ($sort === 'attention') {
          $data = Attention::find()->where(['userId'=>$user])->all();  
           return $this->render('me',['model' => $model,'data'=>$data,'type'=> 'attention']);
        }elseif ($sort === 'picture') {
          $data = UserAlbum::find()->where(['userId'=>$user])->all();  
           return $this->render('me',['model' => $model,'data'=>$data,'type'=> 'picture']);
        }else{
            $data = Likes::find()->where(['userId'=>$user])->all();  
            return $this->render('me',['model' => $model,'data'=>$data,'type'=> 'dynamic']);
        }
    }

    public function actionAttention($id)
    {
        $model = new Attention();
        $model->userId = Yii::$app->user->identity->id;
        $model->objectId = $id;
        $model->objectType = 'user';
        $model->createdTime = time();

        $userModel = User::findone(['id'=>$id]);

        $userModel->attentionCount = count($userModel->attentionMe());
        
        $userModel->save();

        if ($model->save()) {
           
            return $this->redirect(['person','id'=>$id]);
        }

        return $this->redirect(['person','id'=>$id]);
    }

    public function actionAttentionclear($id)
    {
        $model = Attention::find()->where([
            'objectId' => $id,
            'objectType' => 'user',
            'userId' => Yii::$app->user->identity->id,
            ])->one();
       

        if ($model->delete()) {
           
            return $this->redirect(['person','id'=>$id]);
        }

        return $this->redirect(['person','id'=>$id]);
    }

    public function actionAlbum()
    {   
        $foo = new Foo;
        $model = new UserAlbum();
        $id = Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post())) {
            $model->userId = $id;
            $model->createdTime = time();
            $data = array(
                    'img_url' =>  'http://112.74.49.39:8081/images/2.jpg',
                    'attributes' => 'true'
                );
            
            $result = HttpClient::sendHttp('http://faceset.market.alicloudapi.com', '/v2/detection/detect', $data);
            $model->faceId = $result['faces'][0]['id'];
            $data = array(
                    "faceset_id" =>"HMr2zcdYnspTI0CdQz7mTKfDDtZRFgNz3FmwXLVv",
                    "face_id" =>$model->faceId ,
                );
            
            if ($model->save()) {
                $result = HttpClient::sendHttp('http://faceset.market.alicloudapi.com', '/v2/faceset/add_faces',$data);
             
               return $this->redirect(['person','id'=>$id,'sort'=>'picture']);
            }
               return $this->redirect(['person','id'=>$id,'sort'=>'picture']);
        }
    }
    public function actionFacetrain()
    {
        $data = array(
           "faceset_id"=>"HMr2zcdYnspTI0CdQz7mTKfDDtZRFgNz3FmwXLVv",
           "type"=>"life",
           "async"=>"true"
        ); 
        $result = HttpClient::sendHttp('http://faceset.market.alicloudapi.com', '/v2/faceset/train',$data);
        var_dump($result);
    }
}
