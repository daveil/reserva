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
		$schedule = $this->data['Appointment']['schedule'];
		if($this->checkAvailability($schedule)){
			App::Import('Model','Setting');
			$this->Setting = new Setting;
			$refNo =  $this->Setting->getRefNo();
			$this->data['Appointment']['ref_no'] =$refNo;
			$this->Setting->setRefNo($refNo+1);
			return true;
		}else{
			return false;
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
}
