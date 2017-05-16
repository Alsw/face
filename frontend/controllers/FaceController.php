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

	public function actionFacesetarray()
	{
		$host = "http://faceset.market.alicloudapi.com";
	    $path = "/v2/faceset/add_faces";
	    $method = "POST";
	    $appcode = "a81df1bd13a04ddb9b182aaa3e0ecfe9";
	    $headers = array();
	    array_push($headers, "Authorization:APPCODE " . $appcode);
	    array_push($headers, "Content-Type".":"."application/json");
	    //根据API的要求，定义相对应的Content-Type
	    array_push($headers, "Content-Type".":"."application/json; charset=UTF-8");
	    $querys = "";
	    $data = array(
	            "faceset_id" =>"HMr2zcdYnspTI0CdQz7mTKfDDtZRFgNz3FmwXLVv",
	            "face_id" => "6GGwMLdGDc36DqsIOYIkescKFCgCemY7wWzjvjxY",
	            );
	    $bodys = json_encode($data);
	    $url = $host . $path;

	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($curl, CURLOPT_FAILONERROR, false);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_HEADER, true);
	    if (1 == strpos("$".$host, "https://"))
	    {
	        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	    }
	    curl_setopt($curl, CURLOPT_POSTFIELDS, $bodys);
	   

	    $response = curl_exec($curl);
	    $cur_info = curl_getinfo($curl);
	    $body = substr($response, $cur_info['header_size']);
	    curl_close($curl);
	    $responseData = json_decode($body,true);
	    var_dump($responseData);
			
	      

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
		
		
		$result = HttpClient::sendHttp('http://facerecog.market.alicloudapi.com','/v2/detection/detect', $data);

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
		
		$result = HttpClient::sendHttp('http://facerecog.market.alicloudapi.com','/v2/recognition/compare_face', $data);

		return json_encode($result);
	
	}
	public function actionFacecelebrity()
	{

		$faceid = Yii::$app->request->post('faceid','');
		
		$data = array(
			'face_id' => $faceid,
		); 
		
		$result = HttpClient::sendHttp('http://facerecog.market.alicloudapi.com', '/v2/recognition/celebrity', $data);

		return json_encode($result);
	
	}

	public function actionKai()
	{
		return $this->render('likai');
	}
}
