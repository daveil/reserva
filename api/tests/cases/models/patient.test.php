<?php
/* Patient Test cases generated on: 2016-07-10 09:59:45 : 1468115985*/
App::import('Model', 'Patient');

class PatientTestCase extends CakeTestCase {
	var $fixtures = array('app.patient', 'app.appointment');

	function startTest() {
		$this->Patient =& ClassRegistry::init('Patient');
	}

	function endTest() {
		unset($this->Patient);
		ClassRegistry::flush();
	}

}
