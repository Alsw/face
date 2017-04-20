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
use frontend\models\User;
use frontend\models\UserAlbum;



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
                    'imageUrlPrefix' => "http://www.facefrontend.com",
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}",
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
        $user = Yii::$app->user->identity;
        $model = User::findone(['id'=>$id]);
        if ($id == $user->id) {
            return $this->render('me',['model' => $model]);
        }else{
            return $this->render('person',['model' => $model]);  
        }
    }
}
