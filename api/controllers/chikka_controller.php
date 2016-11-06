<?php
class ChikkaController extends AppController {

	var $name = 'Chika';
	var $uses = array('TextMessage');
	function receiver(){
		try{
			$message_type = $_POST["message_type"];
		}catch (Exception $e){
			echo "Error";
			exit(0);
		}

		if (strtoupper($message_type) == "INCOMING"){
			try{
				$message = $_POST["message"];
				$mobile_number = $_POST["mobile_number"];
				$shortcode = $_POST["shortcode"];
				$timestamp = $_POST["timestamp"];
				$request_id = $_POST["request_id"];
				$data=array('id'=>String::uuid(),'message'=>json_encode($_POST));
				$this->TextMessage->save($data);
				echo "Accepted";
				exit(0);
			}
			catch (Exception $e){
				echo "Error";
				exit(0);
			}
		}
		else{
			echo "Error";
			exit(0);
		}
	}
	function deliver(){
			try{
				$message_type = $_POST["message_type"];
			}catch (Exception $e){
				echo "Error";
				exit(0);
			}
			$data=array('id'=>String::uuid(),'message'=>json_encode($_POST));
			$this->TextMessage->save($data);
			if (strtoupper($message_type) == "OUTGOING"){
				//$this->TextMessage->saveDelivery($_POST);
			}else{
				echo "Error";
				exit(0);
			}
	}
}
?>