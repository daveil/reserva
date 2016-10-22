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
			if($this->checkAvailability($schedule)){
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
	function checkAvailability($schedule){
		$conditions = array(
					'conditions'=>array('Appointment.schedule'=>$schedule)
					);
		$count = $this->find('count',$conditions);
		App::Import('Model','Setting');
		$this->Setting = new Setting;
		$maxBooking = $this->Setting->getMaxDailyBooking();
		return $count < $maxBooking;
		
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
