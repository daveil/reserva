<?php
class Patient extends AppModel {
	var $name = 'Patient';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Appointment' => array(
			'className' => 'Appointment',
			'foreignKey' => 'patient_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => array('schedule'=>'DESC'),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	var $hasOne = 'User';

}
