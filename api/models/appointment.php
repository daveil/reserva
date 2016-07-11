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
		App::Import('Model','SystemConfig');
		$this->SystemConfig = new SystemConfig;
		$this->data['Appointment']['ref_no'] = $this->SystemConfig->getRefNo();
		return true;
	}
}
