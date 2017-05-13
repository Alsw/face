<?php
namespace common\components;

/**
* 
*/
class HttpClient
{
	const HOST = "http://facerecog.market.alicloudapi.com";
	const APPCODE = "a81df1bd13a04ddb9b182aaa3e0ecfe9";
	
	public static function sendHttp($path, $data)
	{

		$host = self::HOST;
	    $method = "POST";
	    
	    $appcode = self::APPCODE;
	    $headers = array();
	    array_push($headers, "Authorization:APPCODE " . $appcode);
	    array_push($headers, "Content-Type".":"."application/json");
	    //根据API的要求，定义相对应的Content-Type
	    array_push($headers, "Content-Type".":"."application/json; charset=UTF-8");
	    $querys = "";
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

	    return $responseData;
	}
}