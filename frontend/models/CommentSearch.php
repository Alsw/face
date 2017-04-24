<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Comment;
use frontend\models\UserSearch;

class CommentSearch extends Comment 
{	

    public $datas = array();

	public function findModel($id)
    {
        // $modes = Comment::find()->where([]) 
    }

    public function findModels($objectId,$objectType)
    {
        $data = Comment::find()->where(['objectId'=>$objectId, 'objectType'=>$objectType,'toUserId' => 0])->asArray()->all();
        foreach ($data as $key1 => $value1) {
          $data[$key1]['children'] = Comment::find()->where(['objectId' => $value1['id'], 'objectType'=>'comment'])->all();
        }

        return $data;

    }
   
}