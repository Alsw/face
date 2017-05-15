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
       
        return $this->render('index');
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
               return $this->render('me',[
                'model' => $model,
                ]);
            }
        }
    }
    public function actionPerson($id)
    {   
        $user = $id;
        $sort = Yii::$app->request->get('sort', 'dynamic');
        $model = User::findone(['id'=>$id]);
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
        $model = new UserAlbum();
        $id = Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post())) {
            $model->userId = $id;
            $model->createdTime = time();
            $data = array(
                    'img_base64' =>  'http://112.74.49.39:8081/images/2.jpg',
                    'attributes' => 'true'
                );
            var_dump($model);exit();
            $result = HttpClient::sendHttp('/v2/detection/detect', $data);
            $model->faceId = $result->faces[0]->id;

            if ($model->save()) {
               
               return $this->redirect(['person','id'=>$id,'sort'=>'picture']);
            }
               return $this->redirect(['person','id'=>$id,'sort'=>'picture']);
        }
    }
}
