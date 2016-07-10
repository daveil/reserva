<?php
/* Appointment Test cases generated on: 2016-07-10 09:59:44 : 1468115984*/
App::import('Model', 'Appointment');

class AppointmentTestCase extends CakeTestCase {
	var $fixtures = array('app.appointment', 'app.patient');

	function startTest() {
		$this->Appointment =& ClassRegistry::init('Appointment');
	}

	function endTest() {
		unset($this->Appointment);
		ClassRegistry::flush();
	}

}
