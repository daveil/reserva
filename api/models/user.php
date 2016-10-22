<?php
class User extends AppModel {
	var $name = 'User';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Patient' => array(
			'className' => 'Patient',
			'foreignKey' => 'patient_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'UserModule' => array(
			'className' => 'UserModule',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	public function sendEmail($email,$subject,$message){
		require 'vendors/vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'sg2plcpnl0212.prod.sin2.secureserver.net';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'mail@fulevillanuevamc.com';                 // SMTP username
		$mail->Password = 'j3j3m00n';                           // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;                                    // TCP port to connect to

		$mail->setFrom('mail@fulevillanuevamc.com', 'Fule-Villanueva Medical Clinic');
		$mail->addAddress($email);     // Add a recipient
		$mail->addCC('mail@fulevillanuevamc.com');
		$mail->addReplyTo('mail@fulevillanuevamc.com');

		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = $subject;
		$mail->Body    = $message;

		if(!$mail->send()) {
			return array('status'=>'ERROR','error'=>$mail->ErrorInfo);
		} else {
			return array('status'=>'OK','message'=>'Message sent.');
		}
		
	}
}
