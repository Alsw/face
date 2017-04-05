<?php
namespace yii\common\models;
use yii\base\Object;


/**
 * Created by PhpStorm.
 * User: Aer
 * Date: 2016/10/19
 * Time: 18:18
 */

class userData extends  Object {
    private static $userId;

    public function getUserId(){
        $session = \Yii::$app->session;
        if (empty(self::$userId) && $session['userId'] ) {
            $session = \Yii::$app->session;
            self::$userId = $session['userId'];
        }
        return self::$userId;
    }

    public function setUserId($userId){
        $session = \Yii::$app->session;
        $session['userId'] = $userId;
        return true;
    }
    public function  clears(){
        $session = \Yii::$app->session;
        $session->destroy();
        return true;
    }
}