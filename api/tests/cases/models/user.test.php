<?php
/* User Test cases generated on: 2016-09-03 05:13:27 : 1472850807*/
App::import('Model', 'User');

class UserTestCase extends CakeTestCase {
	var $fixtures = array('app.user', 'app.patient', 'app.appointment', 'app.user_module', 'app.module');

	function startTest() {
		$this->User =& ClassRegistry::init('User');
	}

	function endTest() {
		unset($this->User);
		ClassRegistry::flush();
	}

}
