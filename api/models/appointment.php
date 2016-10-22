<?php
class Appointment extends AppModel {
	var $name = 'Appointment';
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
	function beforeSave(){
		if(isset($this->data['Appointment']['schedule'])){
			$schedule = $this->data['Appointment']['schedule'];
			$timeslot = $this->data['Appointment']['timeslot'];
			$check = $this->checkAvailability($schedule,$timeslot);
			if($check['available']){
				$_USE_REFNO_CTR = false;
				if($_USE_REFNO_CTR){
					App::Import('Model','Setting');
					$this->Setting = new Setting;
					$refNo =  $this->Setting->getRefNo();
					$this->Setting->setRefNo($refNo+1);
				}else{
					$refNo=$this->countAppointments($schedule)+1;
				}
				$this->data['Appointment']['ref_no'] =$refNo;
				return true;
			}else{
				return false;
			}
		}else{
			return true;
		}
	}
	function checkAvailability($schedule,$timeslot,$patient_id=null){
		$cond = array(
					'conditions'=>array(
						array('Appointment.schedule'=>$schedule)
					)
				);
		$count = $this->find('count',$cond);
		$available = true;
		$full = $timecheck = $patientcheck = false;
		$status = array();
		App::Import('Model','Setting');
		$this->Setting = new Setting;
		$maxBooking = $this->Setting->getMaxDailyBooking();
		//FIRST VALIDATION: Less than MAX BOOKING
		$full =  $count >= $maxBooking;
		if($full) 
			array_push($status,'full');
		$available = !$full;
		if(!$full){
			// SECOND VALIDATION: Timeslot available
			$time_cond = $cond;
			array_push($time_cond['conditions'],array("Appointment.timeslot = TIME('$timeslot')"));
			$timecheck = $this->find('count',$time_cond);
			if($timecheck>0){
				array_push($status,'occupied_timeslot');
				$timecheck = true;
			}
				
			//THIRD VALIDATION: Patient appointment once day only
			$patient_cond = $cond;
			if(!$patient_id) $patient_id = $_SESSION['user']['patient_id'];
			array_push($patient_cond['conditions'],array("Appointment.patient_id"=>$patient_id));
			$patientcheck = $this->find('count',$patient_cond);
			if($patientcheck>0){
				array_push($status,'similar_appointment');
				$patientcheck = true;
			}
			//FINAL VALIDATION: Check timeslot availibilty and patient has not yet reserved for this date
			$available =  !$full && !$timecheck &&  !$patientcheck;
		}
		$availibilty = array('available'=>$available,'status'=>$status,'flags'=>array($full,$timecheck,$patientcheck));
		return $availibilty;
		
	}
	function getDates($schedule){
		$month = date("m",strtotime($schedule));
		$fields = array('DISTINCT Appointment.schedule');
		$conditions = array('MONTH(Appointment.schedule)'=>$month );
		$results = $this->find('all',compact('fields','conditions'));
		$schedules = array();
		foreach($results as $r){
			array_push($schedules,$r['Appointment']['schedule']);
		}
		return $schedules;
	}
	function countAppointments($schedule){
		$conditions = array('Appointment.schedule'=>$schedule );
		$count = $this->find('count',compact('conditions'));
		return $count;
	}
}
