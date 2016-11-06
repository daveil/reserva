<?php
class TextMessage extends AppModel {
	var $name = 'TextMessage';
	function sendMessage($mobile,$message){
		App::import('Model','Setting');
		$Setting =  new Setting();
		$_CC = $Setting->getChikkaCreds();
		$shortcode=$_CC['CHIKKA_SHORT_CODE'];
		$client_id = $_CC['CHIKKA_CLIENT_ID'];
		$secret_key = $_CC['CHIKKA_SECRET_KEY'];
		$chikka_request = array(
			"uuid"=>String::uuid(),
			"message_type" => "SEND",
			"mobile_number" => $mobile,
			"shortcode" => $shortcode,
			"message" => $message,
			"client_id" => $client_id,
			"secret_key" => $secret_key
		);
		$json = json_encode($chikka_request);
		$message_id=substr(Security::hash($json),0,32);
		$data = array(
					'id'=>$message_id,
					'message_type'=>"SEND",
					'mobile_number'=>$mobile,
					'message'=>$message
					);
		$this->save($data);
		unset($chikka_request['uuid']);
		$chikka_request['message_id']=$message_id;
		$query_string = http_build_query($chikka_request);
		
		$URL = "https://post.chikka.com/smsapi/request";

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $URL);
		curl_setopt($ch,CURLOPT_POST, count($chikka_request));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $query_string);

		//execute post
		$result = curl_exec($ch);

		//close connection
		curl_close($ch);
		//exit(0);
	}
	function saveDelivery($data){
		try{
			// Retrieve the parameters from the body
			$message_id = $data["message_id"];
			$mobile_number = $data["mobile_number"];
			$shortcode = $data["shortcode"];
			$status = $data["status"];
			$timestamp = $data["timestamp"];
			$credits_cost = $data["credits_cost"];
			$textMessage = $this->findById($message_id);
			$logs = $textMessage['TextMessage']['logs'];
			if(!$logs){
				$logs = "[]";
			}
			$logs = json_decode($deliver_logs,true);
			$log = $data;
			array_push($logs,$log);
			$logs = json_encode($logs);
			$textMessage['TextMessage']['logs']=$logs;
			$this->save($textMessage);
			echo "Accepted";
			exit(0);
		}
		catch (Exception $e){
			echo "Error";
			exit(0);
		}
	}
}
