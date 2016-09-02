<?php
/* Patient Test cases generated on: 2016-09-03 05:13:51 : 1472850831*/
App::import('Model', 'Patient');

class PatientTestCase extends CakeTestCase {
	var $fixtures = array('app.patient', 'app.appointment', 'app.user', 'app.user_module', 'app.module');

	function startTest() {
		$this->Patient =& ClassRegistry::init('Patient');
	}

	function endTest() {
		unset($this->Patient);
		ClassRegistry::flush();
	}

}
