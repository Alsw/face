<?php

namespace frontend\controllers;


use Yii;
use common\components\HttpClient;
class FaceController extends \yii\web\Controller
{	
    public $layout = "face";
	
    // public function actionIndex()
    // {
    //     return $this->render('index');
    // }

    public function actionIndex()
    {
    	return $this->render('index');
	}

	public function actionfacesetarray()
	{
		
		$data = array(
	    	'faceset_id' => $facesetid, 
	   		'type' => "life",
	   		'async' => "true"
	    	);

	    $result = HttpClient::sendHttp('/v2/faceset/train', $data);

	    var_dump($result);
	    exit();
	}

	public function actionFacedetect()
	{
		
		$url = Yii::$app->request->post('img_url','');
		$img_base64 = Yii::$app->request->post('img_base64','');
		if (!empty($url)) {
			$data = array(
				'img_url' =>  $url,
				'attributes' => 'true'
			); 
		}
		if (!empty($img_base64)) {
			$data = array(
				'img_base64' =>  $img_base64,
				'attributes' => 'true'
			); 
		}
		
		
		$result = HttpClient::sendHttp('/v2/detection/detect', $data);

		return json_encode($result);
	}
	public function actionFacecompare()
	{

		$faceid1 = Yii::$app->request->post('faceid1','');
		$faceid2 = Yii::$app->request->post('faceid2','');
		$data = array(
			'face_id1' => $faceid1,
   			'face_id2' => $faceid2
		); 
		
		$result = HttpClient::sendHttp('/v2/recognition/compare_face', $data);

		return json_encode($result);
	
	}
	public function actionFacecelebrity()
	{

		$faceid = Yii::$app->request->post('faceid','');
		
		$data = array(
			'face_id' => $faceid,
		); 
		
		$result = HttpClient::sendHttp('/v2/recognition/celebrity', $data);

		return json_encode($result);
	
	}
}
