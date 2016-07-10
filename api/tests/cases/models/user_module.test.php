<?php
/* UserModule Test cases generated on: 2016-07-10 09:59:45 : 1468115985*/
App::import('Model', 'UserModule');

class UserModuleTestCase extends CakeTestCase {
	var $fixtures = array('app.user_module', 'app.user', 'app.module');

	function startTest() {
		$this->UserModule =& ClassRegistry::init('UserModule');
	}

	function endTest() {
		unset($this->UserModule);
		ClassRegistry::flush();
	}

}
