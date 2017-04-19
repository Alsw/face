<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Comment;
use frontend\models\UserSearch;

class CommentSearch extends Comment 
{	
	public $modelArr = array();
	public $user;
	public $models;
	public $data = array();
	public function findModels($id)
    {   
        if (($models = Comment::find()->where(['objectType'=>0,'objectId' => $id ])->all()) !== null) {
            array_push($this->modelArr, $models);
            foreach ($models as  $value) {
                $this->findModels($value->objectId);
            }
        }else{
        	return $this;
        }
    }
    public function returnModels(){
    	$models = [
    		'models' => $this->models,
    		'user' => $this->user,
    	];
    	return $models;
    }
    public function findObjectModel($objectId, $objectType)
    {	
    	$user = new UserSearch();
        if (($this->models = Comment::find()->where(['objectId' => $objectId, 'objectType' => $objectType])->all()) !== null) {
        	foreach ($this->models as $key => $value) {
        		$data = [
        			'model' => $value,
        			'user' => $user->findModel($value->userId)
        		];
        		array_push($this->data, $data);
        	}
            return $this->data;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}