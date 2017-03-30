<?php
namespace common\controllers;

use yii\base\object;


/**
* 
*/
class ResController extends object
{	
	public $status;

	public $message;

	public $data = [];
	
	public function setStatus($status)
	{
		$this->status = intval($status);
		return $this;
	}
	public function setMessage($message)
	{

		$this->message = $message;
		return $this;
	}
	public function setData($data)
	{
		$this->data = $data;
		return $this;
	}
	public function getRes()
	{
		$resArr = [
            'stata'=>$this->state,
            'message'=>$this->message,
            'data'=>$this->data,
        ];
        return json_encode($resArr ,JSON_UNESCAPED_UNICODE );
	}
}